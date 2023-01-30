FROM php:8.2-fpm AS base

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}
ENV PHP_USER=laravel

WORKDIR /var/www/html

RUN groupadd -g ${GID} ${PHP_USER} && \
    useradd -u ${UID} -g ${GID} ${PHP_USER} && \
    sed -i -E "s/^(user|group) = www-data/\1 = ${PHP_USER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
	libjpeg62-turbo-dev \
	libpng-dev \
	libxpm-dev \
	libwebp-dev \
    libzip-dev \
    zip \
    git
RUN docker-php-ext-configure \
    gd --enable-gd --with-webp --with-jpeg --with-xpm --with-freetype
RUN docker-php-ext-install \
    zip \
    gd \
    pdo \
    pdo_mysql

FROM base AS php
CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]

FROM base AS artisan
USER ${PHP_USER}
ENTRYPOINT ["php", "/var/www/html/artisan"]

FROM base AS composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer
USER ${PHP_USER}
ENTRYPOINT ["composer"]

#FROM php AS production
#RUN docker-php-ext-install opcache
#COPY php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
#CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
