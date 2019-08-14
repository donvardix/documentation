import os
import argparse
import logging
from datetime import datetime

logger = logging.getLogger(__name__)
file_handler = logging.FileHandler('booking.log')
file_handler.setLevel(logging.WARNING)
formatter = logging.Formatter('%(asctime)s %(levelname)s [%(name)s]: %(message)s')
file_handler.setFormatter(formatter)
logger.addHandler(file_handler)


def date_validation(value):
    try:
        date = datetime.strptime(value, '%d-%m-%Y')
    except ValueError:
        raise argparse.ArgumentTypeError("{} is an invalid date".format(value))
    if date < datetime.today():
        raise argparse.ArgumentTypeError("{} the date should not be in the past".format(value))
    return value


booking = argparse.ArgumentParser(description='Helper:')
booking.add_argument('--city', dest='city', required=True, help='search city')
booking.add_argument('--checkin', dest='checkin', required=True, type=date_validation,
                     help='check in date (format: dd-mm-yyyy)')
booking.add_argument('--checkout', dest='checkout', type=date_validation, help='checkout date (format: dd-mm-yyyy)')
booking.add_argument('--user_id', dest='user_id', required=True, help='ID user')
args = booking.parse_args()

venv_dir = os.path.join(os.path.dirname(os.path.abspath(__file__)), '..\\.venv')
activate_script = os.path.join(venv_dir, "Scripts", "activate_this.py")
exec(open(activate_script).read(), {'__file__': activate_script})

logger.warning("Program started")

from scrapy.crawler import CrawlerProcess  # noqa
from booking.spiders.booking_spider import BookingSpider  # noqa
from scrapy.utils.project import get_project_settings  # noqa

process = CrawlerProcess(get_project_settings())
process.crawl(
    BookingSpider,
    search=args.city,
    checkin=args.checkin,
    checkout=args.checkout,
    user_id=args.user_id,
)
process.start()
