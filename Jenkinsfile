pipeline {
  agent {
    docker {
      image 'php:7.2.2-fpm'
      args '''RUN apt-get update
RUN apt-get install -y autoconf pkg-config libssl-dev

RUN apt-get install -y \\
        libfreetype6-dev \\
        libjpeg62-turbo-dev \\
        libmcrypt-dev \\
        libpng12-dev

RUN docker-php-ext-install iconv mcrypt mbstring \\
    && docker-php-ext-install zip \\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \\
    && docker-php-ext-install gd \\
    && docker-php-ext-install mysqli \\
    && docker-php-ext-install pdo pdo_mysql \\
    && docker-php-ext-install gettext \\
    && docker-php-ext-install bcmath'''
    }
    
  }
  stages {
    stage('Dev') {
      steps {
        sh 'apt-get update'
      }
    }
  }
}