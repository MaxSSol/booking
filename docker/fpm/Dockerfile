FROM php:7.4-fpm

WORKDIR /var/www/

RUN apt-get update && apt-get install -y \
        build-essential \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        locales \
        zip \
        jpegoptim optipng pngquant gifsicle \
        vim \
        unzip \
        git \
        curl \
        libonig-dev \
        libzip-dev

RUN apt-get install -y cron && \
    apt-get install -y supervisor

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y libjpeg-dev libpng-dev

RUN docker-php-ext-configure gd --enable-gd --with-jpeg

RUN docker-php-ext-install gd

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
        && docker-php-ext-enable xdebug
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

EXPOSE 9000

CMD service supervisor start; php-fpm
