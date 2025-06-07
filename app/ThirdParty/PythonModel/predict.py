import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'  # Supress TF INFO & WARNING logs

import absl.logging
absl.logging.set_verbosity(absl.logging.ERROR)

import logging
logging.getLogger('tensorflow').setLevel(logging.ERROR)

import sys
import json
import tensorflow as tf
from tensorflow.keras.preprocessing import image 
import numpy as np

try:
    os.chdir(os.path.dirname(os.path.abspath(__file__)))

    model = tf.keras.models.load_model("model_tanaman.h5")

    with open("kelas_label.json", "r") as f:
        label_data = json.load(f)
    index_to_label = label_data["index_to_label"]

    with open("deskripsi.json", "r") as f:
        deskripsi_data = json.load(f)

    mapping_label_ke_deskripsi = {
        "aloevera": "Aloe Vera",
        "banana": "Banana",
        "bilimbi": "Bilimbi",
        "cantaloupe": "Cantaloupe",
        "cassava": "Cassava",
        "coconut": "Coconut",
        "corn": "Corn",
        "cucumber": "Cucumber",
        "curcuma": "Curcuma",
        "eggplant": "Eggplant",
        "galangal": "Galangal",
        "ginger": "Ginger",
        "guava": "Guava",
        "kale": "Kale",
        "longbeans": "Longbeans",
        "mango": "Mango",
        "melon": "Melon",
        "orange": "Orange",
        "paddy": "Paddy",
        "papaya": "Papaya",
        "peperchili": "Peperchili",
        "pineapple": "Pineapple",
        "pomelo": "Pomelo",
        "shallot": "Shallot",
        "soybeans": "Soybeans",
        "spinach": "Spinach",
        "sweetpotatoes": "Sweetpotatoes",
        "tobacco": "Tobacco",
        "waterapple": "Waterapple",
        "watermelon": "Watermelon"
    }

    img_path = sys.argv[1]

    img = image.load_img(img_path, target_size=(224, 224))
    img_array = image.img_to_array(img)
    img_array = np.expand_dims(img_array, axis=0)
    img_array /= 255.0

    pred = model.predict(img_array, verbose=0)
    predicted_class_index = np.argmax(pred[0])

    if predicted_class_index < len(index_to_label):
        label_prediksi = index_to_label[predicted_class_index]
        label = mapping_label_ke_deskripsi.get(label_prediksi, "Label tidak ditemukan")
    else:
        label = "Label tidak ditemukan"

    deskripsi = deskripsi_data.get(label, "Deskripsi tidak ditemukan.")

    print(json.dumps({"label": label, "deskripsi": deskripsi}))

except Exception as e:
    print(json.dumps({"label": "Error", "deskripsi": str(e)}))
