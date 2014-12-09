#GRU H11 - Sindri K.
# http://initd.org/psycopg/docs/usage.html
#
import os
import sys
import time
import datetime
import psycopg2
import psycopg2.extensions
import googleimagefetch

psycopg2.extensions.register_type(psycopg2.extensions.UNICODE)
psycopg2.extensions.register_type(psycopg2.extensions.UNICODEARRAY)

dir = []
accessgroup = []

def getArguments():
	global dir
	global accessgroup
	#dir = ["../public_html/flex/videos/","../public_html/flex/music/"]
	for arg in sys.argv:
		if not "newSearch.py" in arg:
			dir.append(arg)

	f = open('folders.txt','r')
	for line in f:
		array = line.split(":")	
		#print array[0]
		dir.append(array[0])
		#print array[1]
		accessgroup.append(array[1])
		
def insertFile(file, nafn, accessgroup, thumbnail):
	print "inserting"
	#tengin vid gagnagrunn
	conn = psycopg2.connect("dbname=gru user=gru password=scribblefusionhedonismpothead")
	cur = conn.cursor()

	#insert flokkun music eda videos
	if file.endswith(".mp4"):
		print "mp4 - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail, accessgroup) VALUES (%s,%s,%s,%s);""",(file,"videos/" + file, thumbnail, accessgroup))
	elif file.endswith(".mkv"):
		print "mkv - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail, accessgroup) VALUES (%s,%s,%s,%s);""",(file,"videos/" + file, thumbnail, accessgroup))
	elif file.endswith(".avi"):
		print "avi - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail, accessgroup) VALUES (%s,%s,%s,%s);""",(file,"videos/" + file, thumbnail, accessgroup))
	elif file.endswith(".mp3"):
		print "mp3 - " + file
		cur.execute("""INSERT INTO music (nafn, path, thumbnail, accessgroup) VALUES (%s,%s,%s,%s);""",(file,"music/" + file, thumbnail, accessgroup))
	elif file.endswith(".m4a"):
		print "m4a - " + file
		cur.execute("""INSERT INTO music (nafn, path, thumbnail, accessgroup) VALUES (%s,%s,%s,%s);""",(file,"music/" + file, thumbnail, accessgroup))

	#slit tengingar vid gagnagrunn
	conn.commit()
	cur.close()
	conn.close()

def search():
	print "searching"
	getArguments()
	for i, val in enumerate(dir):
		for file in os.listdir((dir[i])):
			try:
				print "leita"
				thumbnail = googleimagefetch.getImage(file, "../public_html/flex/thumbnails/")
				#Endurskyring a skram med html entities
				nafn = file;
				nafn = nafn.replace(" ","&#160;")
				nafn = nafn.replace("/","&#47;")
				nafn = nafn.replace("[","&#91;")
				nafn = nafn.replace("]","&#93;")
				nafn = nafn.replace("(","&#40;")
				nafn = nafn.replace(")","&#41;")
				nafn = nafn.replace("-","&#45;")
				nafn = nafn.replace("'","&#39;")
				nafn = nafn.replace('"',"&#34;")
				nafn = nafn.replace(",","&#44;")				

				if thumbnail != False:
					print dir[i] + accessgroup[i]
					thumbnail = thumbnail.replace("../public_html/flex/","")
		    		insertFile(file, nafn, accessgroup[i], thumbnail)
		    		time.sleep(5)
			except Exception, e:
				print e

#Til ad framkvaema uppfaerslu a klukkutima fresti
while True:
	search()
	print str(datetime.datetime.utcnow()) + ' Waiting one hour'
	time.sleep(60*60)
