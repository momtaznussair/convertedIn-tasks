FROM php:8-fpm-alpine

ENV PHPGROUP=laravel
ENV PHPUSER=laravel

# Add user and group for Laravel
RUN adduser -g ${PHPGROUP} -s /bin/sh -D ${PHPUSER}

# Update PHP-FPM configuration to use the laravel user
RUN sed -i "s/user = www-data/user = ${PHPUSER}/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = ${PHPGROUP}/g" /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html

# Install PHP extensions and necessary packages
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && apk add --no-cache mysql-client msmtp wget procps shadow libzip icu

# Install additional PHP extensions and dependencies
RUN apk add --no-cache --virtual build-essentials icu-dev libzip-dev zlib-dev g++ make autoconf \
    && docker-php-ext-install intl opcache zip bcmath pcntl \
    && apk del build-essentials && rm -rf /usr/src/php*

# Copy Composer from the official image
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Set entrypoint to handle necessary setup commands
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]