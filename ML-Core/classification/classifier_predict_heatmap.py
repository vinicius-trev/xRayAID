# -*- coding: utf-8 -*-
from keras.applications.densenet import DenseNet121
from keras.layers import Input, Dense, Dropout
from keras.layers import LeakyReLU
from keras.models import Model, Sequential
from keras.preprocessing import image
from keras.utils import plot_model
from keras import backend as K

from heatmap.gradcam import GradCAM

import cv2
import keras
import numpy as np
import os
import json
import imutils


import tensorflow as tf
config = tf.ConfigProto()
config.gpu_options.allow_growth = True
session = tf.Session(config=config)
K.set_session(session)

IMG_DIM = [256, 256, 3]

with open("../SETTINGS.json") as f:
    SETTINGS = json.load(f)

SPLIT_NUMBER = 5

TEST_IMG_DIR = os.path.join("../", SETTINGS["TEST_CLEAN_DATA_DIR"])
WEIGHTS = os.path.join(SETTINGS['CLASSIFICATION_WEIGHTS_DIR'], 'classifier_split_%d.h5' % SPLIT_NUMBER)
RESULTS_DIR = os.path.join("../", SETTINGS["CLASSIFICATION_RESULTS_DIR"])


def create_model(input_shape):
    '''
    Define network
    '''
    inputs = Input(shape=input_shape)

    chexNet = DenseNet121(
          include_top=True
        , input_tensor=inputs
        , weights="ChexNet_weight.h5"
        , classes=14
    )

    chexNet = Model(
          inputs=inputs
        , outputs=chexNet.layers[-2].output
        , name="ChexNet"
    )

    model = Sequential()
    
    model.add(chexNet)

    model.add(Dropout(0.5, name="drop_0"))
    model.add(Dense(512, activation=None, name="dense_0"))
    model.add(LeakyReLU(alpha=0.3))
    model.add(Dropout(0.5, name="drop_1"))
    model.add(Dense(1, activation="sigmoid", name="out"))

    model.summary()
    # plot_model(model, to_file="model.png", expand_nested=True, show_shapes=True)

    return model    

def load_image(img_path, show_resized=False, show_original=False, lab_color=False):

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

    # img = image.load_img(img_path, target_size=(256, 256))
    # img_tensor = image.img_to_array(img)                    # (height, width, channels)

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

    model = create_model(IMG_DIM)
    model.load_weights(WEIGHTS)

    # To export model to TF 1.15 Jetson Nano
    # model.save("/home/vinicius/Desktop/teste.h5")

    ###### Evaluation #####
    test_files = os.listdir(TEST_IMG_DIR)
    test_pIds = [f.split('.')[0] for f in test_files]                  #test_pIds and test_files have the same indexes
    test_files = [os.path.join(TEST_IMG_DIR, f) for f in test_files]

    # print(test_files)
    # print(test_pIds)

    # Load image
    i = 0
    cam = GradCAM(model, i, session)

    #Test images
    test_imgs = ["1d0c417b-8b4b-4dfe-8740-c96056359379",
                "000e3a7d-c0ca-4349-bb26-5af2d8993c3d",
                "2c64542c-4e31-4d4a-8a31-a8947996ca98",
                "0d2737a9-4f7c-4e6a-b37a-a620bce1bf8f",
                "02ae4bbd-7dfa-489d-9bbd-e43e60ff876e",
                "28715b54-8198-4bac-b86c-cda1c039b7cd",
                "01767b2b-8915-47ee-9bb8-3511492f7df5",
                "19b7fa0a-5d7e-488c-8431-7872f838ae74",
                "29ea4ef5-f115-4961-9fe6-4c286a78fe82",
                "20952d76-da81-4bd9-a939-7a44145fb68b",
                "1fd5a4d2-b0f2-4d58-bdd9-0dd1862a523f",
                "271afcc2-a753-43cc-8560-2e4d246b1502"]
    j = 0

    for pID, path in zip(test_pIds, test_files):
    
        image_resized, img_original = load_image(test_files[test_pIds.index(test_imgs[j])], lab_color=True)
        j = j + 1
        # image_resized, img_original = load_image(path, lab_color=False)

        # Predict Image
        pred = model.predict(image_resized)

        # Print Classification
        print("Pneumonia Probability: {:.4f}%".format(pred[0][0]*100))

        # CAM - Heatmam
        heatmap = cam.compute_heatmap(image_resized)

        # resize the resulting heatmap to the original input image dimensions
        # and then overlay heatmap on top of the image
        heatmap = cv2.resize(heatmap, (img_original.shape[1], img_original.shape[0]))
        (heatmap, output) = cam.overlay_heatmap(heatmap, img_original, alpha=0.5)

        # draw the predicted label on the output image
        # HILIGHT THIS LABEL
        label = "Pneumonia: {:.4f}%".format(pred[0][0] * 100)
        cv2.rectangle(output, (0, 0), (340, 40), (0, 0, 0), -1)
        cv2.putText(output, label, (10, 25), cv2.FONT_HERSHEY_SIMPLEX,
            0.8, (255, 255, 255), 2)

        # display the original image and resulting heatmap and output image
        # to our screen
        output = np.hstack([img_original, output])
        output = imutils.resize(output, height=800)
        cv2.imshow("Output", output)
        k = cv2.waitKey(0)
        cv2.destroyAllWindows()

        # cv2.imwrite("heatmap_lab_color/" + pID  + "-{:.6f}".format(pred[0][0] * 100)+ ".png", output)

if __name__ == '__main__':
    main()
