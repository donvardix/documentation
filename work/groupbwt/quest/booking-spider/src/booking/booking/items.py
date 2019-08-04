# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy
from scrapy import Field


class BookingItem(scrapy.Item):
    hotel_name = Field()
    full_address = Field()
    address = Field()
    city = Field()
    postcode = Field()
    country = Field()
    description = Field()
    rating = Field()
    hotel_url = Field()
    rooms = Field()
    image_urls = Field()
    images = Field()
    hotel_image = Field()
    created_at = Field()
    updated_at = Field()


class RoomItem(scrapy.Item):
    name = Field()
    image = Field()
    price = Field()
    occupancy = Field()
    variants = Field()


class RoomVariantItem(scrapy.Item):
    price = Field()
    occupancy = Field()
