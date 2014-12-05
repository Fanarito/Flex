#GRU H11 - Sindri K.

import urllib
import urllib2
import json
import simplejson


def getImage(search = "apple", location = "/", ip = "198.52.160.144", referer = "http://tor01.gw.is"):
	try:
		#mynd leitarstrenginn fyrir google image search api
		search = search.replace(" ","")
		search = search.replace("/","")
		search = search.replace("[","")
		search = search.replace("]","")
		search = search.replace("(","")
		search = search.replace(")","")
		search = search.replace("-","")
		search = search.replace("'","")
		search = search.replace('"',"")
		search = search.replace(",","")

		url = ('https://ajax.googleapis.com/ajax/services/search/images?' +
		       'v=1.0&q=' + search + '&userip=' + ip + '')

		request = urllib2.Request(url, None, {'Referer': referer})
		response = urllib2.urlopen(request)

		# gera object fra json'inu
		results = simplejson.load(response)

		#saekja fyrstu mynd fra json svarinu fra google
		mainResult = results.get('responseData').get('results')[0].get('unescapedUrl')
		mainResultName = search

		#til að skyra myndirnar
		if ".jpg" in mainResult:
			mainResultName = mainResultName + ".jpg"
		elif ".jpeg" in mainResult:
			mainResultName = mainResultName + ".jpeg"
		elif ".png" in mainResult:
			mainResultName = mainResultName + ".png"
		else:
			#print url
			mainResultName = mainResult + ".link"

		#vista mynd
		if ".link" in mainResultName:
			return (str(mainResultName).replace(".link",""))
		else:
			urllib.urlretrieve(mainResult, (location + str(mainResultName)))
			return (location + str(mainResultName))

	except Exception, e:
		print e
	
