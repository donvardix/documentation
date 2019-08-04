# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
from sqlalchemy.orm import sessionmaker
from booking.models import db_connect, Hotels, Rooms, Variants
from scrapy import signals
from scrapy.mail import MailSender
from scrapy.utils.project import get_project_settings


class BookingPipeline(object):
    def __init__(self):
        engine = db_connect()
        self.Session = sessionmaker(bind=engine)

    def process_item(self, item, spider):
        session = self.Session()
        hotel = Hotels()
        try:
            hotel.name = item["hotel_name"]
        except KeyError:
            hotel.name = 'not found'
        try:
            hotel.description = item["description"]
        except KeyError:
            hotel.description = 'not found'
        hotel.address = item["address"]
        hotel.city = item["city"]
        hotel.postcode = item["postcode"]
        hotel.country = item["country"]
        try:
            hotel.rating = item["rating"]
        except KeyError:
            hotel.rating = 'not found'
        try:
            hotel.image = item['images'][-1]['path']
        except KeyError:
            hotel.image = 'not found'
        try:
            hotel.url_hotel = item["hotel_url"]
        except KeyError:
            hotel.url_hotel = 'not found'
        try:
            hotel.created_at = item["created_at"]
        except KeyError:
            hotel.created_at = 'not found'
        try:
            hotel.updated_at = item["updated_at"]
        except KeyError:
            hotel.updated_at = 'not found'

        session.add(hotel)
        session.flush()

        for index, room_item in enumerate(item['rooms']):
            room = Rooms()
            room.name = room_item['name']
            try:
                room.image = item['images'][index]['path']
            except IndexError:
                room.image = 'not image'
            try:
                if room_item['price'] is not None:
                    room.price = room_item['price']
                else:
                    room.price = '0'
            except KeyError:
                room.price = '0'
            try:
                room.occupancy = room_item['occupancy']
            except KeyError:
                room.occupancy = 'not found'
            room.hotel_id = hotel.id

            session.add(room)
            session.flush()

            for variant_item in room_item['variants']:
                variant = Variants()
                if variant_item['price'] is not None:
                    variant.price = variant_item['price']
                else:
                    variant.price = '0'
                variant.occupancy = variant_item['occupancy']
                variant.room_id = room.id

                session.add(variant)

        session.commit()

        return item

    @classmethod
    def from_crawler(cls, crawler):
        spider = cls()
        crawler.signals.connect(spider.spider_closed, signals.spider_closed)
        return spider

    def spider_closed(self, spider):
        stat = spider.crawler.stats.get_stats()
        with open('stats.txt', "w") as f:
            for key in stat:
                f.write("%s: %s" % (key, stat[key]) + '\n')

        email_settings = get_project_settings().get("EMAIL_SETTINGS")
        mailer = MailSender(mailfrom=email_settings['mailfrom'], smtphost=email_settings['smtphost'],
                            smtpport=email_settings['smtpport'],
                            smtpuser=email_settings['smtpuser'], smtppass=email_settings['smtppass'])
        return mailer.send(
            to=[email_settings['sendto']],
            subject="Stats parser Scrapy",
            body=str(stat),
            cc=[email_settings['mailfrom']])
