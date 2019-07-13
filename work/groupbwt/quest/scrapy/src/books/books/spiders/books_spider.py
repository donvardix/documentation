from books.items import BooksItem
from scrapy.spiders import CrawlSpider
import logging

logger = logging.getLogger('logger')
#logging.getLogger('scrapy').propagate = False

class BooksSpider(CrawlSpider):
    name = "books"
    allowed_domains = ["books.toscrape.com"]
    start_urls = ['http://books.toscrape.com/']

    def parse(self, response):
        logger.info('Start Parser on %s', response.url)
        for book_url in response.css("article.product_pod > h3 > a ::attr(href)").extract():
            yield response.follow(book_url, callback=self.parse_book_page)
        next_page = response.css("li.next > a ::attr(href)").extract_first()
        if next_page:
            yield response.follow(next_page, callback=self.parse)




    def parse_book_page(self, response):
        item = BooksItem()
        product = response.css("div.product_main")
        item["title"] = product.css("h1 ::text").extract_first()
        item['category'] = response.xpath(
            "//ul[@class='breadcrumb']/li[@class='active']/preceding-sibling::li[1]/a/text()"
        ).extract_first()
        item['description'] = response.xpath(
            "//div[@id='product_description']/following-sibling::p/text()"
        ).extract_first()
        item['price'] = response.css('p.price_color ::text').extract_first()
        item['image_urls'] = ['http://books.toscrape.com/' + response.xpath('//img/@src').extract_first()[6:]]
        item['rating'] = response.xpath(
            '//div[contains(@class, "product_main")]/p[contains(@class, "star-rating")]/@class').extract_first()[12:]
        item['in_stock'] = response.xpath(
            '//div[contains(@class, "product_main")]/p[contains(@class, "availability")]/text()').extract()
        item['in_stock'] = ''.join(item['in_stock']).strip()
        yield item
