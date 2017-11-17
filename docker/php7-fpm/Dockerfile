FROM php:7.1-fpm

MAINTAINER Miljana Mihaldzic <miljana.mihldzic@elfak.rs>

RUN apt-get update && apt-get install -y \
    unzip \
    ant \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libjpeg-turbo-progs \
    libpng12-dev \
    libldap2-dev \
    libxml2-dev \
    libmcrypt-dev \
    libssl-dev \
    libxslt-dev \
    libc-client-dev \
    libkrb5-dev \
    libicu-dev

# Add new user
RUN useradd --shell /bin/bash -u 1000 -o -c "" -m app
RUN usermod -aG www-data app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Belgrade /etc/localtime
RUN "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache
RUN docker-php-ext-install soap
RUN docker-php-ext-install xsl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install dba
RUN docker-php-ext-install zip
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-install imap
RUN docker-php-ext-install gettext
RUN docker-php-ext-install wddx

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
EXPOSE 9001

COPY ./symfony2_permission.sh /etc/init.d/symfony2_permission.sh
COPY ./symfony3_permission.sh /etc/init.d/symfony3_permission.sh

RUN chmod +x /etc/init.d/symfony2_permission.sh
RUN chmod +x /etc/init.d/symfony3_permission.sh

WORKDIR /var/www/app

USER app

RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias sf3="php bin/console"' >> ~/.bashrc
