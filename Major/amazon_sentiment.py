#prepraing data set postive tweets
import nltk
import json
import re
def training(tweet1,ids, names, prices):
  tweet=[]
  with open("training_data.txt","r") as fp:
    for line in fp:
      le=len(line)
      sentiment=line[le-2]
      line=line[0:le-4]
      tweet.append([line,sentiment])
  tweets=[]
  for (words,sentiment) in tweet:
    words_filtered=[e.lower() for e in words.split() if len(e)>=3]
    tweets.append((words_filtered,sentiment))

  def get_words_in_tweets(tweets):
      all_words = []
      for (words, sentiment) in tweets:
        all_words.extend(words)
      return all_words

  def get_word_features(wordlist):
      wordlist = nltk.FreqDist(wordlist)
      word_features = wordlist.keys()
      return word_features

  word_features = get_word_features(get_words_in_tweets(tweets))

  def extract_features(document):
      document_words = set(document)
      features = {}
      for word in word_features:
          features['contains(%s)' % word] = (word in document_words)
      return features
  training_set = nltk.classify.apply_features(extract_features, tweets)
  #training classfier
  classifier = nltk.NaiveBayesClassifier.train(training_set)
  result=[]
  i=0
  for tt in tweet1:
    coutn=0
    for comment in tt:
      if classifier.classify(extract_features(comment.split())) =='1':
        coutn+=1
    ids[i] = ids[i][25:]    
    result.append({'name':ids[i].encode('utf-8'),'total':len(tt),'pos':coutn, 'product':names[i].encode('utf-8').replace("\xe2\x80\x93",""), 'price':prices[i].encode('utf-8')})
    i+=1
  print(result)