FROM php:8.1-apache-buster

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    libldap2-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libzip-dev && apt-get clean

RUN docker-php-source extract

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && docker-php-ext-install pdo_mysql mbstring zip exif pcntl ldap gd

WORKDIR ../

COPY ./ /var/www/app/

COPY ./docker/files/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/app

# RUN composer install --prefer-dist  && echo "APP_KEY=" > .env
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction && echo "APP_KEY=" > .env

#php artisan config:cache && php artisan route:cache && \

RUN chmod 777 -R /var/www/app/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    php artisan key:generate && \
    a2enmod rewrite

# Fix for LDAPS in brusa
RUN sed -i 's/ca-certificates.crt/cacert.pem/g' /etc/ldap/ldap.conf
