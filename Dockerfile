FROM php:7.4-fpm-alpine

WORKDIR /var/www/backend

RUN chmod -R 775 /var/www/backend

RUN docker-php-ext-install pdo pdo_mysql

COPY ./ /var/www/backend
