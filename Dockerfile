FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json ./
RUN composer install --no-interaction --prefer-dist --no-progress --no-scripts --no-plugins

COPY . .
RUN composer dump-autoload --optimize

COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini

EXPOSE 9000

CMD ["php-fpm"]
