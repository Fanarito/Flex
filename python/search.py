﻿#GRU H11 - Sindri K.
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

def getArguments(dir = []):
	#dir = ["../public_html/flex/videos/","../public_html/flex/music/"]
	for arg in sys.argv:
		if not "search.py" in arg:
			dir.append(arg)

	for item in dir:
		print item

	return dir

	
def insertFile(file, nafn, thumbnail):
	#tengin vid gagnagrunn
	conn = psycopg2.connect("dbname=gru user=gru password=scribblefusionhedonismpothead")
	cur = conn.cursor()

	#insert flokkun music eda videos
	if file.endswith(".mp4"):
		print "mp4 - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail) VALUES (%s,%s,%s);""",(file,"videos/" + file, thumbnail))
	elif file.endswith(".mkv"):
		print "mkv - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail) VALUES (%s,%s,%s);""",(file,"videos/" + file, thumbnail))
	elif file.endswith(".avi"):
		print "avi - " + file
		cur.execute("""INSERT INTO videos (nafn, path, thumbnail) VALUES (%s,%s,%s);""",(file,"videos/" + file, thumbnail))
	elif file.endswith(".mp3"):
		print "mp3 - " + file
		cur.execute("""INSERT INTO music (nafn, path, thumbnail) VALUES (%s,%s,%s);""",(file,"music/" + file, thumbnail))
	elif file.endswith(".m4a"):
		print "m4a - " + file
		cur.execute("""INSERT INTO music (nafn, path, thumbnail) VALUES (%s,%s,%s);""",(file,"music/" + file, thumbnail))

	#slit tengingar vid gagnagrunn
	conn.commit()
	cur.close()
	conn.close()

#Virki fyrir uppfaerslu gagnagrunns
def search():
	dir = getArguments()
	for i, val in enumerate(dir):
		for file in os.listdir((dir[i])):
			try:
				thumbnail = googleimagefetch.getImage(file, "../public_html/flex/thumbnails/")
				#Endurskyring a skram med html entities
				nafn = file;
				nafn = nafn.replace(" ","&#160;")
				nafn = nafn.replace("/","&#47")
				nafn = nafn.replace("[","&#91")
				nafn = nafn.replace("]","&#93")
				nafn = nafn.replace("(","&#40")
				nafn = nafn.replace(")","&#41")
				nafn = nafn.replace("-","&#45")
				nafn = nafn.replace("'","&#39")
				nafn = nafn.replace('"',"&#34;")
				nafn = nafn.replace(",","&#44")				

				if thumbnail != False:
					print thumbnail
					thumbnail = thumbnail.replace("../public_html/flex/","")
		    		insertFile(file, nafn, thumbnail)
		    		time.sleep(5)
			except Exception, e:
				print e

#Til ad framkvaema uppfaerslu a klukkutima fresti
while True:
	search()
	print str(datetime.datetime.utcnow()) + ' Waiting one hour'
	time.sleep(60*60)

