from sqlalchemy import create_engine, Column, Table, ForeignKey
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy import Integer, String

from scrapy.utils.project import get_project_settings

Base = declarative_base()


def db_connect():
    return create_engine(get_project_settings().get("CONNECTION_DB"))


class Hotels(Base):
    __tablename__ = "hotels"

    id = Column(Integer, primary_key=True)
    name = Column(String)
    description = Column(String)
    address = Column(String)
    city = Column(String)
    postcode = Column(String)
    country = Column(String)
    rating = Column(Integer)
    image = Column(String)
    url_hotel = Column(String)
    created_at = Column(String)
    updated_at = Column(String)


class Rooms(Base):
    __tablename__ = "rooms"

    id = Column(Integer, primary_key=True)
    name = Column(String)
    image = Column(String)
    price = Column(String)
    occupancy = Column(Integer)
    hotel_id = Column(Integer)


class Variants(Base):
    __tablename__ = "room_variants"

    id = Column(Integer, primary_key=True)
    price = Column(String)
    occupancy = Column(String)
    room_id = Column(Integer)
