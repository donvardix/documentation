# Поднятие проета:

1. Клонировать репазитоорий
2. В каталоге `src/books/books`, переменовать файл `settings.py.example` в `settings.py` и прописать данные от smtp сервера почты
3. В этом же каталоге в файле `db.py` прописать свои данные от базы данных
4. Установить Python 3
5. Открыть консоль и перейти в `папку с проектом -> src` и прописовать след. команды:
    1. `pip install pipenv`
    2. `python -m venv .venv`
    3. `pipenv shell`
    4. `cd books`
    5. `pipenv install Scrapy`
    6. `pipenv install pypiwin32`
6. Для запуска парсера использовать команду `scrapy crawl books`