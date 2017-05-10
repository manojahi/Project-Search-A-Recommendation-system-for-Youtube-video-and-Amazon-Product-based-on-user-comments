import json
import re

with open("data.json","r") as fp:
	content = fp.read()

j = json.loads(content)
s = str(j[0]["reviews"]).encode('utf-8')
print s
#a = json.loads(str(s))
#print a


#print j[0]["ratings"]

#print j[0]["price"]

#print j[0]["url"]

#print j[0]["name"]
