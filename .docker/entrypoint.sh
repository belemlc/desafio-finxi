#!/bin/bash

composer install
php artisan key:generate
php artisan migrate
composer dump-autoload
php artisan db:seed

php-fpm
