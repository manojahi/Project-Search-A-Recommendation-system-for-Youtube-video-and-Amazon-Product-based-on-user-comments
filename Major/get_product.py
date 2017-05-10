import json
import amazon_sentiment as a
import sys

which_file = sys.argv[1]

comments=[]
name=[]
price=[]
url=[]
with open(which_file+'.json') as datafile:
	data=json.load(datafile)
	for each in data:
		n = each["name"].replace("\"", "")
		#n = "\""+n+"\""
		name.append(n)
		price.append(each["price"])
		url.append(each["url"])
		rev=each["reviews"]
		cmt=[]
		for e in rev:
			cmt.append(e["review_header"])
		comments.append(cmt)
#print(price)
#print(name)
#print(comments)
#print(url)

print(a.training(comments, url, name, price))