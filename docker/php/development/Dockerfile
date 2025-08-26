FROM php:7.4-fpm

ARG UID
ARG GID
ARG USER_NAME
ARG SRC_PATH

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
        curl \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libwebp-dev \
        libbz2-dev \
        libicu-dev \
        libzip-dev \
        libonig-dev \
        git unzip; \
    rm -rf /var/lib/apt/lists/*; \
    apt-get clean; \
    # Install php extensions
    docker-php-ext-install pdo_mysql bcmath bz2 intl zip; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
            --with-jpeg \
            --with-webp \
            --with-freetype; \
    docker-php-ext-install gd; \
    # Install XDebug \
    pecl install xdebug-3.1.6 && docker-php-ext-enable xdebug; \
    # User inside container
    touch /run/php-fpm.pid \
    && groupadd -g ${GID} ${USER_NAME} \
    && useradd -u ${UID} -ms /bin/bash -g ${USER_NAME} ${USER_NAME} \
    && chown ${USER_NAME}:${USER_NAME} /run/php-fpm.pid

USER ${USER_NAME}

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
