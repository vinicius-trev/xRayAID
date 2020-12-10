# xRayAID API

This folder contains all necessary data to run xRayAID as an API service.

To run it, create and activate the virtual environment for python 3.6 with the commands. You MUST have python 3.6 installed on your system and **mondoDB** to save all classifications metadata. Be aware about the CUDA version and TF compatibility if you want to use GPU.

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

The API create, load and perform multiple actions, thats why it has multiple endpoints, that was done based on the needed functionalities and website implementation. They are:

- `/predict - POST`: It receive an image and username as input, classify the image, save all the classification metadata on MondoDB and the input/result images on a user directory. 
- `/image - GET`: Based on the username, classification ID, and desired image (raw or filtered) received as input, returns always 2 images, the original and the classified (with heatmap overlay).
- `/favicon - GET/POST`: Used to return the xRayAID icon on HTML pages.
- `/updateText - POST`: Update the additional information inputted by the user on the classification page.
- `/getText - GET`:  Get the additional information text to show it to the user on the classification/visualization page.
- `/getHistory - GET`: Get a JSON with all the classifications done by the user, to print it all in a DataTable.
- `/deleteClassification - GET`: Delete a desired classification by the selected ID.

This code is based on a RESTFUL API and uses a `flask/waitress` backend. It is already modified to run on a deployment environment. If you need, you can change on the last line of the code the IP and PORT where the API is binded (default **localhost:5000**).

The xRayAID pre-trained model can also be found in this folder -> `xrayaid.h5`