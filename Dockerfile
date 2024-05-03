FROM php:8.3.4-fpm-alpine3.19

# Set timezone
ENV TZ=${TZ:-UTC}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install non-dev dependencies
RUN set -eux \
  && apk add --no-cache \
  git vim zip unzip bash curl tzdata icu-libs \
  c-client make ca-certificates imap gmp gettext libssh2 yaml \
  libintl libxslt libpng libwebp libjpeg-turbo freetype imap \
  linux-headers oniguruma libxslt libpq vips \
  gmp libzip libxml2 freetds

# Install dependencies
RUN set -eux \
  && apk add --no-cache --virtual .build_deps \
  libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev imap-dev \
  linux-headers oniguruma-dev libxslt-dev postgresql-dev vips-dev \
  libssh2-dev gmp-dev libzip-dev libxml2-dev freetds-dev yaml-dev \
  $PHPIZE_DEPS \
  \
  # Php extensions
  && docker-php-ext-install \
  mysqli \
  pdo_mysql \
  pdo_pgsql \
  pgsql\
  bcmath \
  mbstring \
  xml \
  gd \
  exif \
  zip \
  soap \
  intl \
  xsl \
  pcntl \
  sockets \
  sysvmsg \
  sysvsem \
  sysvshm \
  opcache \
  imap \
  gmp \
  \
  # Install xdebug
  && pecl install -o -f xdebug \
  && docker-php-ext-enable xdebug \
  \
  # Install YML
  && pecl install -o -f yaml \
  && docker-php-ext-enable yaml \
  \
  # Install redis
  && pecl install -o -f redis \
  && docker-php-ext-enable redis \
  \
  # Install mongodb
  && pecl install -o -f mongodb \
  && docker-php-ext-enable mongodb \
  \
  # Install apcu
  && pecl install -o -f apcu \
  && docker-php-ext-enable apcu \
  \
  # Install ssh2 \
  && pecl install -o -f ssh2 \
  && docker-php-ext-enable ssh2 \
  \
  # Clean php extensions
  && rm -rf /tmp/pear \
  && docker-php-source delete \
  \
  # Clean up
  && apk del --purge .build_deps \
  && rm -rf /var/cache/apk/*

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy php settings
COPY ./docker/php/local.ini ${PHP_INI_DIR}/conf.d/99-php.ini

# Copy entrypoint
COPY ./docker/php/entrypoint /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Workdir
ENV WORKDIR=/var/www/app
RUN mkdir -p ${WORKDIR}
WORKDIR ${WORKDIR}


RUN chown -R www-data:www-data ${WORKDIR}


# Expose port
EXPOSE 9000

# Run entrypoint
CMD ["docker-entrypoint"]