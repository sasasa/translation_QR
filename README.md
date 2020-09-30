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
composer dump-autoload
php artisan db:seed

php artisan make:controller GenresController --resource

composer require laravelcollective/html

npm install
npm run dev
npm run watch





php artisan make:model Seat -m
php artisan make:seeder SeatsTableSeeder
php artisan db:seed --class=SeatsTableSeeder
php artisan make:controller SeatsController --resource

php artisan make:model SeatSession -m
php artisan make:seeder SeatSessionsTableSeeder
php artisan db:seed --class=SeatSessionsTableSeeder


php artisan make:model Order -m
php artisan make:seeder OrdersTableSeeder
php artisan db:seed --class=OrdersTableSeeder
php artisan make:controller OrdersController --resource


php artisan make:model Allergen -m
php artisan make:seeder AllergensTableSeeder
php artisan db:seed --class=AllergensTableSeeder
php artisan make:controller AllergensController --resource
php artisan make:migration create_allergen_item_table

php artisan make:model Payment -m
php artisan make:seeder PaymentsTableSeeder
php artisan db:seed --class=PaymentsTableSeeder
php artisan make:controller PaymentsController --resource

php artisan make:controller UsersController --resource


`