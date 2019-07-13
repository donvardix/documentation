# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy
from scrapy.item import Item, Field


class BooksItem(scrapy.Item):
    title = Field()
    category = Field()
    description = Field()
    price = scrapy.Field()
    image_urls = Field()
    images = Field()
    rating = Field()
    in_stock = Field()