f = open('folders.txt','r')
for line in f:
	array = line.split(":")	
	print array[0]
	print array[1]
	#print line
