# docker-laravel
```
[win]$ exec winpty bash
[win]$ git clone git@github.com:sasasa/translation_QR.git
[win]$ cd translation_QR
[win]$ docker-compose up -d --build
[win]$ docker-compose exec web npm install
[win]$ docker-compose exec web npm audit fix

[win]$ docker-compose exec app bash
[app]$ COMPOSER_MEMORY_LIMIT=-1 composer install
[app]$ cp .env.example .env
[app]$ php artisan key:generate
[app]$ php artisan migrate
[app]$ php artisan db:seed
[app]$ chmod 777 -R storage/
[app]$ php artisan storage:link
```

| email | pass |
| ------------- | ------------- |
| fulltime1@gmail.com  | hogehoge  |
