#!/bin/sh

php artisan cache:clear

php artisan config:clear

# php artisan migrate

php artisan route:cache

php-fpm