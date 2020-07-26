#!/bin/bash

cp .env.example .env

chmod -R 777 storage
chmod -R 777 bootstrap/cache

php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
