# Аналог системи Booking.com
## Технічні відомості
- PHP 7.4
- Laravel 8
- Vue.js 3
- Vuex
- Nginx
- MySQL
- Docker compose
- Ubuntu 20.04

## Для запуску проекту потрібно мати
-docker v 20.10.12^
-docker-compose v 1.26.0^

Створіть .env файл, для цього скопіюйте .env.example. 
У створеному файлі .env потрібно вказати:
- APP_URL(***Наприклад*** `http://localhost`)
- APP_PORT(***Наприклад*** `8082`)
- DB_HOST(`mysql`)
- SANCTUM_STATEFUL_DOMAINS(Вказуємо адресу з `APP_URL`)
- DB_USERNAME(Можете змінити на свою назву)
- DB_PASSWORD(Вкажіть пароль)
- FORWARD_DB_PORT(***Наприклад*** `33061`)
- SESSION_DOMAIN(Якщо `APP_ENV=http://localhots`, вказуємо `localhost`)
- SESSION_SECURE_COOKIE(`false`)


Для запуску контейнерів виконуємо команду:
```bash
docker-compose up --build
```
***Важливо***, якщо порт 8082 занятий, треба змінити його у .env файлі.
Далі треба запустити міграції, для цього потрібно перейти у контейнер app. Спочатку візьмем container id. Для цього виконаємо команду:
```bash
docker ps
```
![docker ps](https://i.postimg.cc/KYBpmtvH/New-Project-1.jpg)

```bash
docker exec -it container_id /bin/bash
```
![docker exec](https://i.postimg.cc/hG34qJM6/New-Project-2.jpg)

Виконаємо команду `composer i`:
```php
composer i
```

Виконаємо команду `php artisan key:generate`:
```php 
php artisan key:generate
```
Виконаємо міграції і запустимо seed:
```php
php artisan migrate:fresh --seed
```

Виконаємо встановлення необхідних пакетів за допомогою команди:
```bash
docker-compose run npm i --force
````

Також, треба запустити npm run watch:
```bash
docker-compose run npm run watch
```

# Результат виконання всіх команд:
![home-page](https://i.postimg.cc/gzFNVYpq/New-Project-3.jpg)
![mobile-view](https://i.postimg.cc/d308VNyn/New-Project-4.jpg)

***Проект доступний за посиланням localhost:8082***

# Реалізований функціонал
- Реєстрація.
- Підтвердження електронної пошти.
- Особистий профіль
- Панель користувача
- Пошук
# Опції для власників
- Створення облікового запису, реєстрація нерухомості, додавання та видалення властивостей
- Підтвердження та скасування бронювань
