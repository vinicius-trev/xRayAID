# -*- coding: utf-8 -*-
# Importing Keras Libraries
import tensorflow as tf
from tensorflow.keras.applications.densenet import DenseNet121
from tensorflow.keras.layers import Input, Dense, Dropout
from tensorflow.keras.layers import LeakyReLU
from tensorflow.keras.models import Model, Sequential, load_model
from tensorflow.keras.preprocessing import image
from tensorflow.keras import backend as K

# Importing Heatmap / GradCAM Generator
from classification.classify import Classify

# Import Other Utilities
import cv2
import numpy as np
import os
import json
import imutils
import argparse
from pathlib import Path
import gc

# Disabling TF Log messages
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '0' 

# Initializing the argparser
parser = argparse.ArgumentParser()
parser.add_argument("-p", "--folder_path", required=True, help="Enter folder with images to be predicted")
parser.add_argument("-m", "--model_path", required=True, help="Path to model that is going to be loaded")
parser.add_argument("-c", "--lab_color", default=False, help="Enable cv2 Lab Filter, preprocessing the image")
parser.add_argument("--show_image", action='store_true', help="Show classified image")
parser.add_argument("--cpu", action='store_true', help="Execute on CPU")
parser.add_argument("-s", "--save", help="Folder to save the predicted images")
args = parser.parse_args()

if args.cpu == True:
    # Disable GPU
    os.environ["CUDA_VISIBLE_DEVICES"] = "-1"

# Disabling TF Log messages
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3' 

# Get sessing that will be used on heatmap generator
session = K.get_session()

def load_image(img_path, show_resized=False, show_original=False, lab_color=False):
    """
    Load an image from a path

        Args:
        img_path: Path to the image that is going to be loaded
        show_resized: Option to show the loaded image resized to 256x256 pixels
        show_original: Option that allow the user to visualize the original image
        lab_color: Preprocess the loaded image with openCV Lab Color filter

        Return
        img_tensor: Image that will be predicted
        img_original: Original Image loaded
    """
    img_original = cv2.imread(img_path)

    if show_original:
        cv2.imshow("Original Image", img_original[0])                           
        cv2.waitKey(0)

    img_tensor = cv2.resize(img_original, (256, 256))
    img_tensor = img_tensor[...,::-1]

    if lab_color:
        # Original
        lab = cv2.cvtColor(img_original, cv2.COLOR_BGR2LAB)
        lab_planes = cv2.split(lab)
        clahe = cv2.createCLAHE(clipLimit=5.0, tileGridSize=(16,16))
        lab_planes[0] = clahe.apply(lab_planes[0])
        lab = cv2.merge(lab_planes)
        img_original = cv2.cvtColor(lab, cv2.COLOR_LAB2BGR)

        # Resized
        lab = cv2.cvtColor(img_tensor, cv2.COLOR_BGR2LAB)
        lab_planes = cv2.split(lab)
        clahe = cv2.createCLAHE(clipLimit=5.0, tileGridSize=(16,16))
        lab_planes[0] = clahe.apply(lab_planes[0])
        lab = cv2.merge(lab_planes)
        img_tensor = cv2.cvtColor(lab, cv2.COLOR_LAB2BGR)

    if show_resized:
        cv2.imshow("Resized Image", img_tensor[0])                           
        cv2.waitKey(0)

    img_tensor = image.img_to_array(img_tensor)
    img_tensor = np.expand_dims(img_tensor, axis=0)         # (1, height, width, channels), add a dimension because the model expects this shape: (batch_size, height, width, channels)
    img_tensor /= 255.                                      # imshow expects values in the range [0, 1]

    return img_tensor, img_original

def main():
    '''
    Main Method

    '''
    # Verify if saved dir exists
    if args.save is not None:
        Path(args.save).mkdir(parents=True, exist_ok=True)
  

    # Load the model -> This model should be saved to work with TF 1.15
    # To do this, the trained model needs to be saved with model.save() in TF 1.8 code
    model = load_model(args.model_path)

    # Initialize object that will calculate the heatmap and prediction
    prediction = Classify(model, session)

    prediction_files = [os.path.join(args.folder_path, f) for f in os.listdir(args.folder_path)]
    for path in prediction_files:
        # Load the image from path
        image_resized, img_original = load_image(path, lab_color=args.lab_color)

        # Predict the image and calculate heatmap
        heatmap, probability = prediction.compute_heatmap(image_resized)
        print("Pneumonia Probability: {:.4f}%".format(probability*100))

        # Resize the resulting heatmap to the original input image dimensions
        # and then overlay heatmap on top of the original image
        heatmap = cv2.resize(heatmap, (img_original.shape[1], img_original.shape[0]))
        (heatmap, output) = prediction.overlay_heatmap(heatmap, img_original, alpha=0.5)

        # Draw the predicted label on the output image
        # HIGHLIGHT THIS LABEL
        label = "Pneumonia: {:.4f}%".format(probability * 100)
        cv2.rectangle(output, (0, 0), (340, 40), (0, 0, 0), -1)
        cv2.putText(output, label, (10, 25), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (255, 255, 255), 2)

        # Display the original image and resulting heatmap and output image
        # to our screen
        output = np.hstack([img_original, output])
        
        if args.show_image == True:
            output = imutils.resize(output, height=800)
            cv2.imshow("Output", output)
            k = cv2.waitKey(0)
            cv2.destroyAllWindows()

        if args.save is not None:
            cv2.imwrite(args.save + "/{:.6f}".format(probability * 100)+ ".png", output)

        gc.collect()

if __name__ == '__main__':
    main()
