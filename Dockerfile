FROM php:8.2-fpm
COPY . /var/www/html
WORKDIR /var/www/html
EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080