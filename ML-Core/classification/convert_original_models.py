# -*- coding: utf-8 -*-
from keras.applications.densenet import DenseNet121
from keras.callbacks import ModelCheckpoint, ReduceLROnPlateau
from keras.layers import (
    Input, Dense, Dropout
)
from keras.layers import LeakyReLU
from keras.models import Model, Sequential
from keras.optimizers import Adam
from keras.preprocessing.image import ImageDataGenerator
from keras.preprocessing import image
from keras import backend as K

import cv2
import keras
import tensorflow as tf
import numpy as np
import os
import pandas as pd
import json

# config = tf.ConfigProto()
# config.gpu_options.allow_growth = True
# session = tf.Session(config=config)
# K.set_session(session)

IMG_DIM = [256, 256, 3]
BATCH_SIZE = 1

with open("../SETTINGS.json") as f:
    SETTINGS = json.load(f)

SPLIT_NUMBER = 5 

WEIGHTS = "./weights/weights_original/classifier_split_%d.h5" % SPLIT_NUMBER

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

    return model


def main():
    # '''
    # Main Method
    # '''

    model = create_model(IMG_DIM)
    model.load_weights(WEIGHTS)

    model.save("./weights/weights_original_saved/classifier_split_{}.h5".format(SPLIT_NUMBER))


if __name__ == '__main__':
    main()
