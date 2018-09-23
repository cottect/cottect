FROM php:7.2.2-fpm

RUN apt-get update
RUN apt-get install -y autoconf pkg-config libssl-dev

RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev

RUN docker-php-ext-install iconv mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install gettext \
    && docker-php-ext-install bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crontab
RUN apt-get -y install cron

# Vim editor
RUN apt-get -y install vim
RUN export EDITOR=vim

RUN apt-get update

# GIT
RUN apt-get -y install git

# WGET
RUN apt-get -y install wget gnupg

# NET TOOLS

RUN curl -sL https://deb.nodesource.com/setup_6.x | bash - && \
  apt-get install -y nodejs && \
  apt-get install build-essential

# Allow root composer
RUN export COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get -y install procps

# PHP Unit
RUN wget https://phar.phpunit.de/phpunit.phar
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit

# SPEED UP COMPOSE
RUN composer global require hirak/prestissimo

RUN apt-get -y install nginx

# Install Supervisor.
RUN \
    apt-get install -y supervisor && \
    sed -i 's/^\(\[supervisord\]\)$/\1\nnodaemon=true/' /etc/supervisor/supervisord.conf

RUN npm cache clean -f

RUN npm install -g n

RUN n stable

RUN npm install npm@latest -g

RUN npm install -g yarn
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
