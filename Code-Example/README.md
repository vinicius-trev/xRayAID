# Code Example

This folder contains code that exemplifies the use of the machine learning model and its modules.

To run it, create and activate the virtual environment for python 3.6 with the commands. You MUST have python 3.6 installed on your system. Be aware about the CUDA version and TF compatibility if you want to use GPU.

``` bash
# To install Python 3.6
$ sudo add-apt-repository ppa:fkrull/deadsnakes
$ sudo apt-get update
$ sudo apt-get install python3.6

# VirtualEnv (virtualenv + virtualenvwrapper)
$ mkvirtualenv --python=python3.6 xrayaid
$ workon 
$ pip install -r requirements.txt
```

# xRay Examples

The folder `test_sample` has 12 images removed from the test dataset. You can run the example code passing those folder as input to visualize each classification.

# Run The Example

Just type:
``` bash
$ python predict_images.py --folder_path <sample_images_folder> --model_path <.h5 model>
```

There are also other parameters available:

`--lab_color`: (True/False) Enable CV2 Lab Filter, preprocessing the image (default=False) \
`--show_image`: Show each classified image in an openCV window \
`--cpu`: Run the classification model on CPU \
`--save`: Path to the folder to save predicted images