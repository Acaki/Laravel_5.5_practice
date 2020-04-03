FROM php:7.4-apache

RUN a2enmod rewrite headers
RUN cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN apt-get update && apt-get install telnet git zip libcurl4-openssl-dev pkg-config libssl-dev -y
RUN docker-php-ext-install mysqli pdo_mysql
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
WORKDIR /var/www/html
RUN composer install

RUN TZ=Asia/Taipei && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
