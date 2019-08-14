from booking.itemloaders import BookingItemLoader, RoomItemLoader, RoomVariantItemLoader
from booking.items import RoomItem, RoomVariantItem

import scrapy
from datetime import datetime, timedelta


class BookingSpider(scrapy.Spider):
    name = "booking"
    allowed_domains = ["booking.com"]

    def __init__(self, search=None, checkin=None, checkout=None, user_id=None):
        super().__init__()

        self.search = search
        self.user_id = user_id
        checkin = datetime.strptime(checkin, '%d-%m-%Y')
        if checkout is None:
            checkout = checkin + timedelta(days=1)
        else:
            checkout = datetime.strptime(checkout, '%d-%m-%Y')
        self.get_params = {
            "ss": search,
            "checkin_year": checkin.year,
            "checkin_month": checkin.month,
            "checkin_monthday": checkin.day,
            "checkout_year": checkout.year,
            "checkout_month": checkout.month,
            "checkout_monthday": checkout.day,
            "group_adults": '1',
            "group_children": '0',
            "no_rooms": '1',
            "from_sf": '1'
        }

    def get_params_string(self, separator='&'):
        params_string = separator.join(
            map(lambda pair: '='.join(map(str, pair)), zip(self.get_params.keys(), self.get_params.values()))
        )
        return params_string

    def start_requests(self):
        if self.get_params is not None:
            params_string = self.get_params_string()
            url = "https://www.booking.com/searchresults.ru.html?{}".format(params_string)
            yield scrapy.Request(url)

    def parse(self, response):

        for hotel_url in response.xpath('//a[@class="hotel_name_link url"]/@href').extract():
            hotel_url = hotel_url.strip().split('\n')[0]
            hotel_url = hotel_url.split('?')[0]
            hotel_url = "https://www.booking.com" + hotel_url
            url = response.urljoin(hotel_url)
            yield scrapy.Request(url, self.parse_hotel)

        next_page = response.xpath('//a[contains(@class, "bui-pagination__link paging-next")]/@href')
        if next_page:
            url = response.urljoin(next_page[0].extract())
            yield scrapy.Request(url, self.parse)

    def parse_hotel(self, response):
        hotel_loader = BookingItemLoader(response=response)
        hotel_loader.add_xpath('hotel_name', '//h2[@id="hp_hotel_name"]/text()')
        hotel_loader.add_xpath('full_address', 'normalize-space(//*[contains(@class, "hp_address_subtitle")]/text())')
        hotel_loader.add_xpath('description', 'normalize-space(//div[@id="property_description_content"]//p/text())')
        hotel_loader.add_xpath('rating', 'normalize-space(//*[@class="bui-review-score__badge"]/text())')
        hotel_loader.add_value('hotel_url', response.url)
        hotel_loader.add_xpath('hotel_image', '//div[contains(@class, "clearfix bh-photo-grid")]/div/a/@href')
        hotel_loader.add_xpath('hotel_image', '//div[contains(@class, "hp-gallery-slides")]/div/img/@src')

        rooms = self.get_room_table_data(response)

        room_items = []

        for room in rooms:
            variant_items = []
            if 'variants' in room:
                for variant in room['variants']:
                    variant_items.append(RoomVariantItem(variant))
            room_dict = {k: v for k, v in room.items() if k != 'variants'}
            variant_items = list(map(dict, variant_items))
            room_item = RoomItem(
                **room_dict,
                variants=variant_items
            )
            room_items.append(room_item)

        image_urls = [room['image'] for room in room_items if 'image' in room and room['image'] is not None]
        room_items = list(map(dict, room_items))

        hotel_item = hotel_loader.load_item()

        if hotel_item['hotel_image'] is not None:
            image_urls.append(hotel_item['hotel_image'])
        try:
            if hotel_item['rating'] is not None:
                hotel_item['rating'] = hotel_item['rating'].replace(',', '.', 1)
            else:
                hotel_item['rating'] = '0'
        except KeyError:
            hotel_item['rating'] = '0'

        hotel_item['rooms'] = room_items
        hotel_item['image_urls'] = image_urls
        hotel_item['created_at'] = datetime.now()
        hotel_item['updated_at'] = datetime.now()
        split_address = hotel_item['full_address'].split(',')
        hotel_item['address'] = split_address[0]
        hotel_item['city'] = self.search
        hotel_item['user_id'] = self.user_id
        hotel_item['postcode'] = split_address[-2][1:]
        hotel_item['country'] = split_address[-1][1:]
        yield hotel_item

    def get_room_table_data(self, response):
        table = response.xpath('//table[contains(@class, "hprt-table")]')
        if len(table) > 0:
            return self.parse_hpt_table(table, response)
        else:
            table = response.xpath('//table[contains(@class, "roomstable rt_no_dates")]')
            return self.parse_roomstable(table, response)

    def parse_hpt_table(self, table, response):
        rooms = []

        room_rows = table.xpath('tbody/tr[.//span[@class="hprt-roomtype-icon-link "]]')

        i = 1
        for row in room_rows:
            room_loader = RoomItemLoader(selector=row)
            room_loader.add_xpath('name', './/span[contains(@class, "hprt-roomtype-icon-link")]/text()')
            room_loader.add_xpath('price', './/div[contains(@class, "hprt-price-price")]'
                                           '/div[contains(@class, "hprt-price-price-actual")]//text()')
            room_loader.add_xpath('price', './/div[contains(@class, "hprt-price-price")]//text()')
            room_loader.add_value('price', row.xpath('.//text()').re(r'UAH.*\s\d+'))
            room_loader.add_xpath('occupancy', './/td[contains(@class, "hprt-table-cell-occupancy")]//span[contains('
                                               '@class, "bui-u-sr-only")]/text()')
            room_id = row.xpath('.//a[contains(@class, "hprt-roomtype-link")]/@href').extract_first()
            if room_id is None:
                image = None
            else:
                room_id = room_id[1:]
                room_modal_id = 'blocktoggle{}'.format(room_id)
                room_modal = response.xpath('//div[@id="{}"]'.format(room_modal_id))
                image = room_modal.xpath('.//div[@class="hprt-lightbox-gallery"][1]//img[1]/@data-lazy').extract_first()

            room_loader.add_value('image', image)

            variant_rows = table.xpath(
                'tbody'
                '/tr'
                '[count(preceding-sibling::tr[.//span[@class="hprt-roomtype-icon-link "]])={} '
                'and not(.//span[@class="hprt-roomtype-icon-link "]) '
                'and not(count(td)=1)]'.format(i)
            )

            room_item = room_loader.load_item()

            variants = self.parse_room_variants(variant_rows)
            variants.append(RoomVariantItem(price=room_item.get('price'), occupancy=room_item.get('occupancy')))
            room_item['variants'] = list(map(dict, variants))
            rooms.append(room_item)
            i += 1

        return rooms

    def parse_roomstable(self, table, response):
        rooms = []
        room_rows = table.xpath('tbody/tr')

        for row in room_rows:
            room_loader = RoomItemLoader(selector=row)
            room_loader.add_xpath('name', 'td[1]/text()')
            room_loader.add_xpath('occupancy', 'td[2]/span/@title')
            room_loader.add_xpath('price', 'td[3]//text()')
            rooms.append(room_loader.load_item())

        return rooms

    def parse_room_variants(self, variant_rows):
        variants = []
        for row in variant_rows:
            variant_loader = RoomVariantItemLoader(selector=row)
            variant_loader.add_xpath('price', './/div[contains(@class, "hprt-price-price")]//text()')
            variant_loader.add_value('price', row.xpath('.//text()').re(r'UAH.*\s\d+'))
            variant_loader.add_xpath('occupancy', './/td[contains(@class, "hprt-table-cell-occupancy")]'
                                                  '//span[contains(@class, "bui-u-sr-only")]//text()')
            variants.append(variant_loader.load_item())

        return variants
