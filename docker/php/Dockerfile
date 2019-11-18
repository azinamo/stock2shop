FROM php:7.2-fpm-alpine

ENV PHPIZE_DEPS \
    autoconf \
    cmake \
    file \
    g++ \
    gcc \
    libc-dev \
    pcre-dev \
    make \
    git \
    pkgconf \
    re2c \
    # for GD
    freetype-dev \
    libpng-dev  \
    libjpeg-turbo-dev
RUN apk add --no-cache --virtual .persistent-deps \
    # for intl extension
    icu-dev \
    # for postgres
    postgresql-dev \
    # for soap
    libxml2-dev \
    # for amqp
    libressl-dev \
    # for GD
    freetype \
    libpng \
    libjpeg-turbo
RUN set -xe \
    # workaround for rabbitmq linking issue
    && ln -s /usr/lib /usr/local/lib64 \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure mysqli --with-mysqli \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-configure mbstring --enable-mbstring \
    && docker-php-ext-configure soap --enable-soap \
    && docker-php-ext-install -j$(nproc) \
        gd \
        bcmath \
        intl \
        pcntl \
        mysqli \
        pdo_mysql \
        mbstring \
        soap \
        iconv \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && rm -rf /var/cache/apk/* && rm -rf /tmp/*

COPY config/php7.ini /usr/local/etc/php/conf.d/

COPY config/php-fpm.conf /usr/local/etc/
COPY config/pool.d /usr/local/etc/pool.d

# Clear package lists
RUN rm -rf /var/lib/apt/lists/*


WORKDIR /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod u+rwx,g+rx,o+rx /var/www/html

RUN ls -la

COPY ./startup.sh /startup.sh

#RUN composer install --no-interaction

EXPOSE 9000

ENTRYPOINT ["/startup.sh"]
