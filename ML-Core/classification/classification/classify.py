# import the necessary packages
from keras.models import Model
import tensorflow as tf
import numpy as np
import cv2

class Classify:
    def __init__(self, model, session, layerName=None, classIdx=0):
        # store the model, the class index used to measure the class
        # activation map, and the layer to be used when visualizing
        # the class activation map
        self.model_chexnet = model.layers[0]
        self.model = model
        self.classIdx = classIdx
        self.layerName = layerName
        self.session = session

        # if the layer name is None, attempt to automatically find
        # the target output layer
        if self.layerName is None:
            self.layerName = self.find_target_layer()

        # construct our gradient model by supplying (1) the inputs
        # to our pre-trained model, (2) the output of the (presumably)
        # final 4D layer in the network, and (3) the output of the
        # softmax activations from the model
        self.gradModel = Model(
            inputs=self.model.get_layer("ChexNet").inputs,
            outputs=self.model.get_layer("ChexNet").get_layer("bn").output)

        self. gradModel2 = Model(
                inputs=self.model.inputs,
                outputs=self.model.output)


    def find_target_layer(self):
        # attempt to find the final convolutional layer in the network
        # by looping over the layers of the network in reverse order
        for layer in reversed(self.model_chexnet.layers):
            # check to see if the layer has a 4D output
            if len(layer.output_shape) == 4:
                return layer.name

        # otherwise, we could not find a 4D layer so the GradCAM
        # algorithm cannot be applied
        raise ValueError("Could not find 4D layer. Cannot apply GradCAM.")

    def compute_heatmap(self, image, eps=1e-8):
        # record operations for automatic differentiation
        with tf.GradientTape(persistent=True) as tape:
            # cast the image tensor to a float-32 data type, pass the
            # image through the gradient model, and grab the loss
            # associated with the specific class index
            inputs = tf.cast(image, tf.float32)

            convOutputs = self.gradModel(inputs)
            predictions = self.gradModel2(inputs)
            loss = predictions[:, self.classIdx]


        guidedGrads = convOutputs

        # the convolution and guided gradients have a batch dimension
        # (which we don't need) so let's grab the volume itself and
        # discard the batch
        convOutputs = convOutputs[0]
        guidedGrads = guidedGrads[0]

        # compute the average of the gradient values, and using them
        # as weights, compute the ponderation of the filters with
        # respect to the weights
        weights = tf.reduce_mean(guidedGrads, axis=(0, 1))
        cam = tf.reduce_sum(tf.multiply(weights, convOutputs), axis=-1)
        cam = tf.nn.relu(cam) # Remove negative numbers, better for visualization

        # grab the spatial dimensions of the input image and resize
        # the output class activation map to match the input image
        # dimensions
        (w, h) = (image.shape[2], image.shape[1])
        heatmap = cv2.resize(cam.eval(session=self.session), (w, h))

        # normalize the heatmap such that all values lie in the range
        # [0, 1], scale the resulting values to the range [0, 255],
        # and then convert to an unsigned 8-bit integer
        numer = heatmap - np.min(heatmap)
        denom = (heatmap.max() - heatmap.min()) + eps
        heatmap = numer / denom
        probability = loss.eval(session=self.session)
        heatmap = heatmap * probability # Use the probability to paint
        heatmap = (heatmap * 255).astype("uint8")
        

        # return the resulting heatmap to the calling function
        return heatmap, probability[0]

    def overlay_heatmap(self, heatmap, image, alpha=0.5,
        colormap=cv2.COLORMAP_INFERNO):
        # apply the supplied color map to the heatmap and then
        # overlay the heatmap on the input image
        heatmap = cv2.applyColorMap(heatmap, colormap)
        output = cv2.addWeighted(image, alpha, heatmap, 1 - alpha, 0)

        # return a 2-tuple of the color mapped heatmap and the output,
        # overlaid image
        return (heatmap, output)