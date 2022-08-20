FROM php:8.1-fpm

COPY . /app

WORKDIR /app

RUN apt-get update \
    && apt-get install -y zip unzip libzip-dev default-mysql-client \
    && docker-php-ext-install zip pdo_mysql

# Install composer for the application dependencies
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install project dependencies
RUN composer install -noa