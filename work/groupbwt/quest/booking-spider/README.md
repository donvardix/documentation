# Поднятие проета:

1. Клонировать репазитоорий
1. В каталоге `src/booking/booking`, переменовать файл `settings.py.example` в `settings.py` и прописать данные от smtp сервера почты и базы данных
1. Установить Python 3
1. Открыть консоль и перейти в `папку с проектом -> src` и прописовать след. команды:
    1. `pip install pipenv`
    1. `pipenv shell`
    1. `pipenv install`
    1. `exit`
    1. `pipenv shell`
    1. `cd booking`
    1. `alembic upgrade head`
1. Для запуска парсера перейти в `src/booking` и использовать команду `python StartParser.py --city {city} --checkin {checkin} --checkout {checkout}`
### Параметры:
* `{city}` - Город
* `{checkin}` - Дата заезда
* `{checkout}` - Дата отъезда (не обязательный параметр)

Пример: `python StartParser.py --city Запорожье --checkin 03-08-2019 --checkout 05-08-2019`
### Прокси:
Для запуска парсера через прокси, использовать файл `proxies.txt` в каталоге `src/booking`

Пример:
```
https://134.249.150.130:81
```