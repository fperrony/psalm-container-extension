FROM php:7.3-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update  \
    && apt-get install -y \
      git \
      libzip-dev \
      libyaml-dev \
      unzip \
      zip \
    && docker-php-ext-install zip

RUN pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug

RUN pecl install yaml-2.0.4 \
    && docker-php-ext-enable yaml

