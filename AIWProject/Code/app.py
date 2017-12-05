import numpy as np
import matplotlib.pyplot as plt
from matplotlib import style
from sklearn.cluster import KMeans
import csv
import sklearn
from flask import Flask,render_template



app = Flask(__name__)

@app.route("/")
def main():
	time_data = []
	with open("/home/ganesh/Engineering/7 SEM/AIW/Dataset/MOCK_DATA.csv",'r') as f:
		entire_data = list(csv.reader(f,delimiter=','))
	for i in range(1,len(entire_data)):
		time_data.append([int(entire_data[i][1])])
	#print (time_data)
	time_data = np.array(time_data)
	#time_data.reshape(-1,1)
	kmeans = KMeans(n_clusters = 4)
	kmeans.fit(time_data)

	centroids = kmeans.cluster_centers_
	labels = kmeans.labels_
	user_type_time = [100]
	prediction_cluster = kmeans.predict(user_type_time)
	if(prediction_cluster[0] == len(centroids)-1):
		print ("The query belongs to the ",prediction_cluster[0]," cluster")
		

	print (prediction_cluster)
	print(centroids)
	print(labels)
	return render_template('index.html')

if __name__ == "__main__":
	#load_data()
	app.run()
