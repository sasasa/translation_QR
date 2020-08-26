# translation_QR

`
composer create-project laravel/laravel --prefer-dist translation_QR
$mysql -u root -p
CREATE DATABASE translation CHARACTER SET utf8;
GRANT ALL PRIVILEGES ON translation.* TO root@localhost IDENTIFIED BY '';

php artisan migrate


php artisan make:model Item -m

php -r "copy('https://readouble.com/laravel/6.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"


php artisan make:controller ItemsController --resource

php artisan make:seeder ItemsTableSeeder
php artisan db:seed --class=ItemsTableSeeder
php artisan storage:link


composer require laravel/ui --dev
php artisan ui vue --auth
npm install
npm run dev
npm run watch


composer require laravel/helpers


php artisan make:model Genre -m
php artisan make:seeder GenresTableSeeder
php artisan db:seed --class=GenresTableSeeder
php artisan make:seeder UsersTableSeeder
php artisan db:seed --class=UsersTableSeeder

php artisan migrate:refresh
php artisan db:seed


php artisan make:controller GenresController --resource


composer require laravelcollective/html
`