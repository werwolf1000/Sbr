FROM php:8.2-cli as development


RUN apt-get -qq update && apt-get -qq -y install \
    git \
    libzip-dev \
    unzip \
    librabbitmq-dev \
  libxml2-dev
RUN docker-php-ext-install simplexml xml

