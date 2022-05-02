# Using the pattern found at https://www.honeybadger.io/blog/laravel-docker-php/

FROM composer:2.3 as build
WORKDIR apps/makoto
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM registry.digitalocean.com/tharp/laravel-base:latest AS base
WORKDIR apps/makoto

COPY --from=build /app /var/www/html

RUN php artisan config:cache && \
    php artisan route:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

EXPOSE 80
