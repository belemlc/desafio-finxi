#!/bin/bash

composer install
php artisan key:generate --force
php artisan migrate
composer dump-autoload
php artisan passport:install
php artisan db:seed

php-fpm
