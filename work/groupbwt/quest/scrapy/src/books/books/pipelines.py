from books.db import DB
from scrapy import signals
from scrapy.mail import MailSender

class BooksPipeline(object):
    def process_item(self, item, spider):
        DB.insert_data(self,
            item['title'],
            item['category'],
            item['description'],
            item['price'],
            item['images'][0]['path'],
            item['rating'],
            item['in_stock'])

        return item

    @classmethod
    def from_crawler(cls, crawler):
        spider = cls()
        crawler.signals.connect(spider.spider_closed, signals.spider_closed)
        return spider

    def spider_closed(self, spider):
        email_settings = spider.crawler.settings.getdict("EMAIL_SETTINGS")
        stat = spider.crawler.stats.get_stats()
        with open('stats.txt', "w") as f:
            for key in stat:
                f.write("%s: %s" % (key, stat[key]) + '\n')

        mailer = MailSender(mailfrom=email_settings['mailfrom'], smtphost=email_settings['smtphost'], smtpport=email_settings['smtpport'],
                            smtpuser=email_settings['smtpuser'], smtppass=email_settings['smtppass'])
        return mailer.send(
            to=[email_settings['sendto']],
            subject="Stats parser Scrapy",
            body=str(stat),
            cc=[email_settings['mailfrom']])
