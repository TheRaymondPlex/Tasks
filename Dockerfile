FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo_mysql \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite