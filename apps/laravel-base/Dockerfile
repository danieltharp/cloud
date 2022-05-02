FROM php:8-apache AS base
RUN apt update \
        && apt install -y \
            curl \
            g++ \
            libicu-dev \
            libfreetype-dev \
            libjpeg-dev \
            libpng-dev \
            libpq-dev \
            libssl-dev \
            libzip-dev \
            zip \
            zlib1g-dev \
    && docker-php-ext-install \
            intl \
            opcache \
            pdo \
            pdo_mysql

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd

COPY apps/laravel-base/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
