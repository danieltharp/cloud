# Using the pattern found at https://www.honeybadger.io/blog/laravel-docker-php/
WORKDIR apps/makoto

FROM composer:2.3 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

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

COPY --from=build /app /var/www/html
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN php artisan config:cache && \
    php artisan route:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

EXPOSE 80
