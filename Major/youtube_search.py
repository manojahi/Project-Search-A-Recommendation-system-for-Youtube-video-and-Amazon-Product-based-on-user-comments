from apiclient.discovery import build #pip install google-api-python-client
from apiclient.errors import HttpError #pip install google-api-python-client
from oauth2client.tools import argparser #pip install oauth2client
import pandas as pd #pip install pandas
import youtube_sentiment as s2
import sys

def get_comment_threads(youtube, video_id):
  try:
    results = youtube.commentThreads().list(
    part="snippet",
    videoId=video_id,
    textFormat="plainText"
    ).execute()
    k=0
    texts=[]
    for item in results["items"]:
      comment = item["snippet"]["topLevelComment"]
      author = comment["snippet"]["authorDisplayName"]
      text = comment["snippet"]["textDisplay"]
      texts.append(text)
      k=k+1

    return (texts)
  except Exception:
  	return ("")

if __name__ == "__main__":
	#search_term = ""
	#for arg in sys.argv:
	#	search_term = search_term+" "+arg	

	search_term = sys.argv[1]
	if "+" in search_term:
		search_term.replace("+", " ")
	
	DEVELOPER_KEY = "AIzaSyBrVhg5nfkVrgGJGm9TUhiFqc1Me6mSj3s" 
	YOUTUBE_API_SERVICE_NAME = "youtube"
	YOUTUBE_API_VERSION = "v3"
	argparser.add_argument("--q", help="Search term", default=search_term)
	#change the default to the search term you want to search
	argparser.add_argument("--max-results", help="Max results", default=10)
	#default number of results which are returned. It can vary from 0 - 100
	args=argparser.parse_args()
	options = args
	youtube = build(YOUTUBE_API_SERVICE_NAME, YOUTUBE_API_VERSION, developerKey=DEVELOPER_KEY)
	# Call the search.list method to retrieve results matching the specified
	# query term.
	search_response = youtube.search().list(
		q=options.q,
		type="video",
		part="id,snippet",
		maxResults=options.max_results
		).execute()
	videos = {}
	for search_result in search_response.get("items", []):
		videos[search_result["id"]["videoId"]] = search_result["snippet"]["title"]
		s = ','.join(videos.keys())
	ids=s.split(',')
	comments=[]
	for i in ids:
		try:
			comments.append(get_comment_threads(youtube,i))
		except ValueError:
			continue
			#print()
	s2.training(comments,ids)
