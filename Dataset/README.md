# DATASET

This folder is responsible to store the RSNA-Pneumonia-Challenge Dataset, which can be found [here](https://www.kaggle.com/c/rsna-pneumonia-detection-challenge/leaderboard). Since the pourpose of git isn't to store a hole dataset, the expected folder structure, after download, is:

- `dataset-analysis`: Contains some CSV files with informations about the dataset.
- `stage_2_test_images`: Contains all DICOM **TEST** images downloaded from the Dataset.
- `stage_2_test_images_png`: Contains all the converted PNG **TEST** images downloaded from the Dataset.
- `stage_2_train_images`: Contains all DICOM **TRAIN** images downloaded from the Dataset.
- `stage_2_train_images_png`: Contains all the converted PNG **TRAIN** images downloaded from the Dataset.
- `utils`: Jupyter notebooks used to analyze the dataset and convert the DICOM images to PNG.
