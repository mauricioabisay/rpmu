FROM php:7-fpm
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring

WORKDIR /app
COPY . /app