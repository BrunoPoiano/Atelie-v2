FROM php:7.4-apache

RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libxml2-dev \
        libssl-dev \
        curl \
        zip \
        unzip \
        openssl \
        && docker-php-ext-configure gd --with-freetype=/usr --with-jpeg=/usr \
        && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql soap bcmath zip

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite 

# make sure www-data owns /var/www
RUN chown -R www-data:www-data /var/www

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN rm /bin/sh && ln -sf /bin/bash /bin/sh

# RUN apt-get install -y supervisor

# COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html

RUN mkdir -p /var/www/html/storage/logs



