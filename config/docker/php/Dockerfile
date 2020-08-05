FROM php:7.4-fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libzip-dev \
        libxml2-dev \
        libpng-dev \
        vim curl debconf git apt-transport-https apt-utils \
        build-essential locales acl mailutils wget nodejs zip unzip \
        gnupg gnupg1 gnupg2 \
        sudo \
    && docker-php-ext-install \
        pdo_mysql \
        soap \
        zip \
        opcache \
        gd \
        intl
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.idekote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN wget --no-check-certificate https://phar.phpunit.de/phpunit-6.5.3.phar && \
    mv phpunit*.phar phpunit.phar && \
    chmod +x phpunit.phar && \
    mv phpunit.phar /usr/local/bin/phpunit
RUN echo "deb https://deb.nodesource.com/node_6.x jessie main" >> /etc/apt/sources.list.d/nodejs.list && \
    wget -nv -O -  https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add - && \
    echo "deb-src https://deb.nodesource.com/node_6.x jessie main" >> /etc/apt/sources.list.d/nodejs.list && \
    apt-get update && \
    apt-get install -y --force-yes nodejs && \
    rm -f /etc/apt/sources.list.d/nodejs.list
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && \
    apt-get install yarn
RUN usermod -u 1000 www-data
RUN usermod -a -G www-data root
RUN mkdir -p /var/www
RUN chown -R www-data:www-data /var/www
WORKDIR /var/www/projet/