#!env python

import json
import os

import redis
from bs4 import BeautifulSoup
import requests


API_DOMAIN = os.getenv('API_DOMAIN', 'frontend')


def get_title(url):
    content = requests.get(url).text
    soup = BeautifulSoup(content, 'html.parser')
    return soup.title.string


def update_link(id, title):
    url = "http://{0}/api/v1/links/{1}".format(API_DOMAIN, id)
    data = {"title": title}
    response = requests.put(url=url, data=data)
    return response.status_code == requests.codes.ok


def handle(message):
    title = get_title(message["url"])
    updated = update_link(message["id"], title)
    if updated:
        print("Link updated.")
    else:
        print("Error updating link.")


def main():
    print("Starting worker...")
    host = os.getenv('REDIS_HOST', 'redis')
    client = redis.Redis(host=host, port=6379, db=0)
    channel = client.pubsub()
    channel.subscribe('link_created')

    for message in channel.listen():
        print("Received: {0}".format(message))
        if message["type"] != "message":
            continue
        try:
            data = json.loads(message["data"].decode("utf-8"))
            if 'url' in data:
                handle(data)
        except Exception as ex:
            print("Error handling message")
            print(ex)


if __name__ == "__main__":
    main()