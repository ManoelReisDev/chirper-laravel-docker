FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    unzip \
    $PHPIZE_DEPS \
  && docker-php-ext-install -j$(nproc) bcmath intl mbstring opcache pdo_mysql zip \
  && apk del $PHPIZE_DEPS \
  && rm -rf /var/cache/apk/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www/html \
  && chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]