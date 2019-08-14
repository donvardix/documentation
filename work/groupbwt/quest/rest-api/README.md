<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Поднятие проета:

1. Клонировать репазитоорий
2. Переменовать файл `.env.example` в `.env` и прописать данные от своей Базы Данных
3. Открыть консоль и перейти в папку с проектом и прописовать след. команды:
    1. `composer install`
    2. `php artisan key:generate`
    3. `php artisan migrate`
    4. `php artisan queue:work`

### Сиды:
* `php artisan db:seed` - создание тестового админа и пользователя
* `php artisan db:seed --class=HotelsTableSeeder` - создание 1000 тестовых записей отелей и комнат
### Тесовые пользователи:
* **Admin** - admin@gmail.com:12345678
* **User** - user@gmail.com:12345678
### База дынных:
Dump БД находится в `sql/booking.sql`
### Документация API:
**URN:** `/documentation`