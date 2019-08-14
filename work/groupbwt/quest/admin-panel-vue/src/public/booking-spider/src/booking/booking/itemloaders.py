import re
from scrapy.loader import ItemLoader
from scrapy.loader.processors import TakeFirst, MapCompose, Join
from w3lib.html import replace_tags
from booking.items import BookingItem, RoomItem, RoomVariantItem


def clean_string(s):
    return replace_tags(
        s.strip().replace('\xa0', ' '),
        ' '
    )

def replace_image_size(url):
    return re.sub(r'max\d+/', 'max1024x768/', url)


class BookingItemLoader(ItemLoader):
    default_item_class = BookingItem

    default_input_processor = MapCompose(clean_string)
    default_output_processor = TakeFirst()

    main_image_in = MapCompose(clean_string, replace_image_size)


class RoomItemLoader(ItemLoader):
    default_item_class = RoomItem

    default_input_processor = MapCompose(clean_string)
    default_output_processor = TakeFirst()


class RoomVariantItemLoader(ItemLoader):
    default_item_class = RoomVariantItem

    default_input_processor = MapCompose(clean_string)
    default_output_processor = TakeFirst()
