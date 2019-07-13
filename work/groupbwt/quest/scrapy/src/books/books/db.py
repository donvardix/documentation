from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker
from sqlalchemy import Column, Integer, String

db_settings = {
    'host': 'localhost',
    'db': 'scrapy',
    'user': 'root',
    'passwd': '',
}

Base = declarative_base()
engine = create_engine('mysql+pymysql://' + db_settings['user'] + ':' + db_settings['passwd'] + '@' + db_settings['host'] + '/' + db_settings['db'])
Session = sessionmaker(bind=engine)
session = Session()


class DB(Base):
    __tablename__ = 'books'
    id = Column(Integer, primary_key=True)
    title = Column(String)
    category = Column(String)
    description = Column(String)
    price = Column(String)
    image = Column(String)
    rating = Column(String)
    in_stock = Column(String)

    def insert_data(self, title, category, description, price, image, rating, in_stock):
        objBooks = DB(title=title, category=category, description=description, price=price, image=image, rating=rating,
                      in_stock=in_stock)
        session.add(objBooks)
        session.commit()
