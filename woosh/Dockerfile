FROM php:8.1-fpm

WORKDIR /var/www/html

COPY . /var/www/html/

RUN apt-get update && apt-get install curl

RUN curl -sS https://getcomposer.org/installer | php

RUN composer install

EXPOSE 8000
CMD [ "php", "artisan", "serve", "-p", "8000" ]
