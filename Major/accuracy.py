import nltk
import json
import re
def training():
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
  tweet1=[]
  for i in range(0,50):
    tweet1.append(tweet[i])
  count=0
  for i in range(0,50):
    val=classifier.classify(extract_features(tweet1[i][0].split()))
    if(val==tweet1[i][1]):
      count+=1
  print(count/(1.0*50))
if __name__ == "__main__":
  training()