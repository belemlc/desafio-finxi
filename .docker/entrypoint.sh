#!/bin/bash

composer install
php artisan key:generate --force
php artisan migrate
composer dump-autoload
php artisan passport:install
php artisan db:seed
# Roda o npm e instala as depndencias do front
npm install && npm run dev
php-fpm
