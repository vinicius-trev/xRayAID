"""
 * xRayAID - REST API
 * API/run_keras_server.py
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
"""

# Importing Keras Libraries
import tensorflow as tf
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import img_to_array
from tensorflow.compat.v1.keras import backend as K

# Importing Heatmap / GradCAM Generator
from classification.classify import Classify

# Import openCV to preprocess the image and overlay the heatmap
import cv2

# Importing RESTful API Deps and MongoDB
import numpy as np
import flask
import os
import json
import ast
import pymongo
import shutil
import waitress

# Other deps
import logging
import sys
import io
import time
import gc

# initialize our Flask application
app = flask.Flask(__name__)

# Initialize Global Variables, used on Flask Threads
SAVE_DATA_PATH = "../UserData/"
MODEL_PATH = "xrayaid.h5"
inferencer = None
database = None
logger = None

os.environ["CUDA_VISIBLE_DEVICES"] = "-1"     # Uncomment to disable Jetson Nano GPU

# Configurating Tensorflow / Keras Session and Graph
tf.get_logger().setLevel('INFO')
tf.reset_default_graph()
gpu_options = tf.GPUOptions(per_process_gpu_memory_fraction=0.192) # Aproximatelly 768 MB dedicated to TF
session_conf = tf.ConfigProto(intra_op_parallelism_threads=1, inter_op_parallelism_threads=1, gpu_options=gpu_options)
graph = tf.compat.v1.get_default_graph()
session = tf.compat.v1.Session(graph=graph, config=session_conf)

# Configuring Logger Application
def create_logger():
    """
        Create default logger for application
    """

    global logger
    logger = logging.getLogger(__name__)
    logger.setLevel(logging.INFO)
    handler = logging.StreamHandler()
    handler.setLevel(logging.DEBUG)
    formatter = logging.Formatter('%(asctime)s - %(name)s - %(levelname)s - %(message)s')
    handler.setFormatter(formatter)
    logger.addHandler(handler)
    gc.collect()

# Function do Load ML model
def load_xrayaid_model():
    """
        Create and load ML model references
    """

    # Global variables
    global session
    global inferencer
    global graph
    global logger

    # Loading and creating the models
    tf.compat.v1.keras.backend.set_session(session)
    densenet = load_model(MODEL_PATH)
    inferencer = Classify(densenet, session, graph)
    logger.info("xRayAID Network Loaded")
    gc.collect()

# Function do Load MongoDB Database
def load_database():
    """
        Create database it does not exist
        Load it if it exists
    """
    global database
    global logger

    try:
        mongod = pymongo.MongoClient("mongodb://localhost:27017/")
        logger.info("Connected successfully to MongoDB Server!!!")
    except:
        logger.info("Could not connect to MongoDB Server")
        sys.exit(1)

    if "xrayaid-data" in mongod.list_database_names():
        logger.info("Database exists, skipping creation!")
    else:
        logger.info("Database does not exist, creating it!")
        
    # Loading / Creating DB
    db = mongod["xrayaid-data"]
    database = db["userdata"]
    gc.collect()

# Function to process the input received by the REST POST API
def process_input(img_original, lab_color=False):
    """
        Preprocess image received by POST request

        Args:
        image: binary image received by the request
        lab_color: Preprocess the loaded image with openCV Lab Color filter

        Return
        img_tensor: Image that will be predicted
    """
    img_tensor = cv2.resize(img_original, (256, 256))
    img_tensor = img_tensor[...,::-1] #Convert BGR to RGB

    # If lab_color is specified, apply that filter to the image
    if lab_color:
        # Original (raw image converte with lab filter)
        lab = cv2.cvtColor(img_original, cv2.COLOR_BGR2LAB)
        lab_planes = cv2.split(lab)
        clahe = cv2.createCLAHE(clipLimit=5.0, tileGridSize=(16,16))
        lab_planes[0] = clahe.apply(lab_planes[0])
        lab = cv2.merge(lab_planes)
        img_original = cv2.cvtColor(lab, cv2.COLOR_LAB2BGR)

        # Resized (network input with lab filter)
        lab = cv2.cvtColor(img_tensor, cv2.COLOR_BGR2LAB)
        lab_planes = cv2.split(lab)
        clahe = cv2.createCLAHE(clipLimit=5.0, tileGridSize=(16,16))
        lab_planes[0] = clahe.apply(lab_planes[0])
        lab = cv2.merge(lab_planes)
        img_tensor = cv2.cvtColor(lab, cv2.COLOR_LAB2BGR)

    img_tensor = img_to_array(img_tensor)
    img_tensor = np.expand_dims(img_tensor, axis=0)         # (1, height, width, channels), add a dimension because the model expects this shape: (batch_size, height, width, channels)
    img_tensor /= 255.                                      # imshow expects values in the range [0, 1]
    
    gc.collect()
    return img_tensor, img_original

def save_predicion_database(input_image, input_image_lab, input_ext, heatmap_original, heatmap_lab, username, probability):
    """
        Insert request data on mongoDB database

        Args:
        input_image: binary image received by the request
        input_image_lab: binary image received by the request with lab filter
        input_ext: input image extension from form
        heatmap_original: heatmap overlayed image calculated by the model
        heatmap_lab: heatmap overlayed image calculated by the model with lab filter
        username: username received on request
        probability: pneumonia probability calculated by the model

        Return
        True/False for validation
    """

    # Global database variable context
    global database
    global logger

    # Save original and heatmap image on SAVE_SATA_PATH with validations
    # Check if username dir exists
    try:
        # Creating userfolder if it does not exists
        if(not os.path.isdir(os.path.join(SAVE_DATA_PATH, username))):
            os.mkdir(os.path.join(SAVE_DATA_PATH, username), 0o770)
    except:
        logger.info("Failed to Check for username folder")
        gc.collect()
        return False
    
    # Create folder with timestamp
    try:
        # Creating timestamp folder
        timestamp = str(int(time.time()))
        if(not os.path.isdir(os.path.join(SAVE_DATA_PATH, username, timestamp))):
            os.mkdir(os.path.join(SAVE_DATA_PATH, username, timestamp), 0o770)
    except:
        logger.info("Failed to Create timestamp dir")
        gc.collect()
        return False

    # Save original and heatmap images inside these heatmap folder
    try:
        # Saving
        cv2.imwrite(os.path.join(SAVE_DATA_PATH, username, timestamp, "original." + input_ext), input_image)
        cv2.imwrite(os.path.join(SAVE_DATA_PATH, username, timestamp, "original_lab." + input_ext), input_image_lab)
        cv2.imwrite(os.path.join(SAVE_DATA_PATH, username, timestamp, "heatmap_original.JPEG"), heatmap_original)
        cv2.imwrite(os.path.join(SAVE_DATA_PATH, username, timestamp, "heatmap_lab.JPEG"), heatmap_lab)
    except:
        logger.info("Failed to Save images inside timestamp dir")
        os.rmdir(os.path.join(SAVE_DATA_PATH, username, timestamp))
        gc.collect()
        return False


    # Build insert request
    insert_request = {
        'username': username,
        'probability': probability,
        'classification_id': timestamp,
        'original_extension': input_ext,
        'heatmap_extension': "JPEG",
        'annotations': '',
        'feedback': ''
    }
    
    # Inserting data
    try:
        # Insert metadata
        database.insert_one(insert_request)
        logger.info("Request inserted on MongoDB with success")
        gc.collect()
        return True, timestamp
    except:
        logger.info("Failed to store request on MongoDB")
        gc.collect()
        return False, Null


# Function to process API requests
# This will infer new images and save relevant informations on MongoDB database
@app.route("/predict", methods=["POST"])
def predict():
    """
        Predict the image based on API POST Request
    """

    # Initialize the data dictionary that will be returned to user
    data = {"success": False}

    # Ensure an image was properly uploaded to our endpoint and username field exist
    if flask.request.method == "POST":
        if flask.request.files.get("image") and flask.request.form.get("data"):

            # Read the image and convert it to 
            file = flask.request.files["image"]
            image_form = np.fromstring(file.read(), np.uint8)
            image_form = cv2.imdecode(image_form, cv2.IMREAD_COLOR)

            # Getting form inputs
            received_data = flask.request.form.to_dict()

            # Preprocess the image, prepare it for classification and save the original image
            # that way, we can save it on MongoDB
            raw_extension = (file.filename.split(".")[-1]).upper()
            if raw_extension == "JPG":
                raw_extension = "JPEG"
            
            image, raw_image = process_input(image_form, lab_color=False)
            image_lab, raw_image_lab = process_input(image_form, lab_color=True)

            # Classify the input image and then initialize the list
            # of prediction to return to the client
            global session
            global graph
            global inferencer
            global logger

            with graph.as_default():
                tf.compat.v1.keras.backend.set_session(session)
                heatmap, probability = inferencer.compute_heatmap(image)
                heatmap_lab, probability_lab = inferencer.compute_heatmap(image_lab)

                # Heatmap Overlay
                heatmap_original = cv2.resize(heatmap, (raw_image.shape[1], raw_image.shape[0]))
                heatmap_lab = cv2.resize(heatmap_lab, (raw_image_lab.shape[1], raw_image_lab.shape[0]))
                (_, output_original) = inferencer.overlay_heatmap(heatmap_original, raw_image, alpha=0.5)
                (_, output_lab) = inferencer.overlay_heatmap(heatmap_lab, raw_image_lab, alpha=0.5)
            gc.collect()

            # Add the pneumonia probability to the list of returned prediction
            data["pneumonia_probability"] = (float(probability) + float(probability_lab)) / 2

            # Add the username to the request, that way we can validate on Website and save on DB
            data["username"] = ast.literal_eval(received_data["data"])["username"]

            # Indicate that the request was a success
            data["success"] = True

            # Save prediction informations on mongodb
            return_value, classification_id = save_predicion_database(raw_image, raw_image_lab, raw_extension, output_original, output_lab, data["username"], data["pneumonia_probability"])

            if return_value == False:
                logger.info("Fail to save request data")
                data = {"success": False}
            else:
                 data["classification_id"] = classification_id

    # Return the data dictionary as a JSON response and
    # Clear previous data (Used to not increase memory)
    K.clear_session()
    tf.reset_default_graph()
    gc.collect()
    return flask.jsonify(data)

# Function to return heatmap or original image from mongoDB
# Return the image only on GET request
@app.route("/image", methods=["GET"])
def get_image():
    """
        Get the requested image from mongodb based on its unique ID
    """
    # Ensure that the GET request is valid
    if flask.request.method == "GET":
        if flask.request.args.get('username') and flask.request.args.get('id') and flask.request.args.get('image'):
            global database

            username = flask.request.args.get('username')
            timestamp_id = str(flask.request.args.get('id'))
            image_type = flask.request.args.get('image')

            # Getting file extension from database info for the image
            try:
                if 'heatmap' in image_type:
                    db_type = 'heatmap'
                else:
                    db_type = 'original'

                image_extension = database.find_one({"classification_id":timestamp_id, "username": username})[db_type + "_extension"]
            except:
                logger.info("Database request failed or data does not exist")
                gc.collect()
                return ('', 204) 

            # Loading image with openCV
            try:
                loaded_image = cv2.imread(os.path.join(SAVE_DATA_PATH, username, timestamp_id, image_type + "." + image_extension))
            except:
                logger.info("Error loading image from GET request")
                gc.collect()
                return ('', 204)  
        
            # Writing image in memory with its format
            try:
                _, buffer = cv2.imencode(str('.' + image_extension), loaded_image)
                file_img = io.BytesIO(buffer)
            except:
                logger.info("Error Decoding image")
                return ('', 204)  

            # Return image
            gc.collect()
            return flask.send_file(file_img, mimetype=image_extension)

    gc.collect()
    return ('', 204)        

# Sending favicon
@app.route('/favicon.ico') 
def favicon(): 
    """
        Get the favicon to webpage
    """
    gc.collect()
    return flask.send_from_directory(os.path.join(app.root_path), 'favicon.png', mimetype='image/PNG')


# Update text fields (annotations and/or feedback) on mongoDB based on classification ID and username
@app.route('/updateText', methods=["POST"]) 
def add_information(): 
    """
        Update annotations and feedback data on mongodb based on classification id and username
    """
    # Ensure that the field in form exists
    if flask.request.method == "POST":
        if flask.request.form.get("username") and flask.request.form.get("classification_id") and (flask.request.form.get("feedback") or flask.request.form.get("annotations")):

            received_data = flask.request.form.to_dict()
            username = str(received_data['username'])
            timestamp_id = str(received_data['classification_id'])
            annotations = str(received_data['annotations'])
            feedback= str(received_data['feedback'])

            # Update fields on mongodb register
            global database

            try:
                database.update_one({"classification_id": timestamp_id, "username": username}, { '$set': { 'annotations': annotations, 'feedback': feedback}})
            except:
                logger.info("Error updating text fields on database")
                gc.collect()
                return ('', 204)  

            gc.collect()
            return ('', 200)  

    gc.collect()
    return ('', 204)

# Get annotations and/or feedback from timestamp_id
@app.route('/getText', methods=["GET"]) 
def get_information(): 
    """
        Get annotations and feedback based on username and request ID
    """
    # Ensure that the field in form exists
    if flask.request.method == "GET":
        if flask.request.args.get("username") and flask.request.args.get("id"):

            username = flask.request.args.get('username')
            timestamp_id = str(flask.request.args.get('id'))
            data = {}

            # Get feedback and annotations from mongoDB
            global database

            try:
                query = database.find_one({"classification_id": timestamp_id, "username": username})
                data['feedback'] = query['feedback']
                data['annotations'] = query['annotations']
            except:
                logger.info("Error getting text fields on database")
                gc.collect()
                return ('', 204)  

            gc.collect()
            return flask.jsonify(data)

    gc.collect()
    return ('', 204)

# Get history from specific user
@app.route('/getHistory', methods=["GET"]) 
def get_history(): 
    """
        Get history based on username

        Returns JSON populated with id (timestamp and date) and pneumonia probability
    """
    # Ensure that the field in form exists
    if flask.request.method == "GET":
        if flask.request.args.get("username"):

            username = flask.request.args.get('username')
            data = {}

            # Get id and pneumonia probability from all entries of user on MongoDB
            global database

            try:
                query = database.find({"username": username})
                for result in query:
                    data[result['classification_id']] = {"pneumonia_probability": result['probability'], "classification_id": result['classification_id']}

            except:
                logger.info("Error getting history from database")
                gc.collect()
                return ('', 204)  

            gc.collect()
            return flask.jsonify(data)

    gc.collect()
    return ('', 204) 


# Delete classification with specific id from the received user
@app.route('/deleteClassification', methods=["GET"]) 
def delete_Classification(): 
    """
        Delete classification based on username and ID

        Returns Success or Error
    """
    # Ensure that the field in form exists
    if flask.request.method == "GET":
        data = {}
        if flask.request.args.get("username") and flask.request.args.get("id"):

            username = flask.request.args.get('username')
            timestamp_id = str(flask.request.args.get('id'))

            # Delete data from mongoDB and user folder
            global database

            try:
                # Deleting data from mongoDB
                query = database.delete_one({"classification_id": timestamp_id, "username": username})

                if(query.deleted_count != 0):
                    # Deleting classification from user folder
                    path = os.path.join(SAVE_DATA_PATH, username, timestamp_id)
                    shutil.rmtree(path)
                    data = {"success": True}
                
                else:
                    data = {"success": False}

            except:
                logger.info("Error deleting classification")
                data = {"success": False}
        else:
            data = {"success": False}

    gc.collect()
    return flask.jsonify(data)

# This is the main thread of execution, first load the model and
# then start the server
if __name__ == "__main__":
    # Creating Logger
    create_logger()
    logger.info("Loading xRayAID model and starting Flask server... \nPlease wait until server has fully started")
    
    # Loading MongoDB
    load_database()
    
    # Load the inferencer
    load_xrayaid_model()

    # Start Flask server, don't need key, running locally
    # app.run(host='127.0.0.1', threaded=True) # Replaced for deployment
    waitress.serve(app, host='127.0.0.1', port=5000) 
