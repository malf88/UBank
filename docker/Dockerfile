FROM php:7.4-apache
MAINTAINER Marco Aurélio <malf88@gmail.com>

WORKDIR /var/www

COPY ./ /var/www/


ENV APACHE_DOCUMENT_ROOT /var/www/


# Install apache, PHP, and supplimentary programs. openssh-server, curl, and lynx-cur are for debugging the container.
RUN apt-get update && apt-get -y upgrade && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
        nano \
        libcurl4-gnutls-dev \
        libxml2-dev \
        ftp \
        libzip-dev \
        libpng-dev && \
    docker-php-ext-install \
        bcmath \
        calendar \
        #hash \
        #mbstring \
        sockets \
        zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini


RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" $PHP_INI_DIR/php.ini
RUN sed -i "s/display_errors = .*$/display_errors = On/" $PHP_INI_DIR/php.ini
RUN sed -i "s/CipherString = .*$/#CipherString/" /etc/ssl/openssl.cnf


# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP root
ENV APACHE_LOG_DIR /var/log/
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV COMPOSER_ALLOW_SUPERUSER 1

# Expose apache.
EXPOSE 80
ADD ./docker/apache2.conf /etc/apache2/apache2.conf
ADD ./docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf


# By default start up apache in the foreground, override with /bin/bash for interative.
