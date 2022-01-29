FROM php:8.0.7-fpm

ARG APP_ENV
ARG DB_HOST
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD
ARG DB_PORT
ARG GITHUB_ACCESS_TOKEN

ENV APP_ENV=$APP_ENV
ENV DB_HOST=$DB_HOST
ENV DB_DATABASE=$DB_DATABASE
ENV DB_USERNAME=$DB_USERNAME
ENV DB_PASSWORD=$DB_PASSWORD
ENV DB_PORT=$DB_PORT

ENV PHPREDIS_VERSION=5.3.4
ENV ENTRYKIT_VERSION 0.4.0
ENV DOCKERIZE_VERSION v0.6.1

RUN apt-get update -y && \
    apt-get install -y libzip-dev zip libpq-dev libpcre3-dev zlib1g-dev libpng-dev libmcrypt-dev curl libcurl4-openssl-dev vim libjpeg-dev libfreetype6-dev libxml2-dev libonig-dev git libicu-dev unzip zlib1g-dev \
  && docker-php-source extract \
  && curl -L -o /tmp/redis.zip https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.zip \
  && cd /tmp \
  && unzip /tmp/redis.zip \
  && rm -r /tmp/redis.zip  \
  && mv /tmp/phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
  && docker-php-ext-configure zip --with-zip \
  && docker-php-ext-configure gd --with-freetype=/usr/include --with-jpeg=/usr/include \
  && docker-php-ext-install pdo_pgsql pgsql gd zip exif redis intl

# Install entrykit
RUN curl -OL https://github.com/progrium/entrykit/releases/download/v${ENTRYKIT_VERSION}/entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
    && tar -xvzf entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
    && rm entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
    && mv entrykit /bin/entrykit \
    && chmod +x /bin/entrykit \
    && entrykit --symlink

# Install dockerize
RUN curl -OL https://github.com/jwilder/dockerize/releases/download/${DOCKERIZE_VERSION}/dockerize-linux-amd64-${DOCKERIZE_VERSION}.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-${DOCKERIZE_VERSION}.tar.gz \
    && rm dockerize-linux-amd64-${DOCKERIZE_VERSION}.tar.gz

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

COPY . /var/www/html
COPY ./etc/docker/scheduler/docker-entrypoint.sh /bin/docker-entrypoint.sh
COPY ./etc/docker/app/php-fpm.d/docker.conf /usr/local/etc/php-fpm.d/zzz-docker.conf
COPY ./etc/docker/app/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./etc/docker/scheduler/php.ini /usr/local/etc/php/php.ini
COPY ./etc/docker/bin/wait_db_connect.sh /usr/local/bin/wait_db_connect.sh
COPY ./etc/docker/bin/composer_install.sh /usr/local/bin/composer_install.sh

RUN chmod -R 777 /var/www/html/storage/*

RUN composer config -g github-oauth.github.com ${GITHUB_ACCESS_TOKEN}
RUN composer self-update

RUN if [ "$APP_ENV" != 'local' ]; then \
      composer install --no-dev; \
  fi

VOLUME /var/www/html

CMD ["/bin/docker-entrypoint.sh"]
