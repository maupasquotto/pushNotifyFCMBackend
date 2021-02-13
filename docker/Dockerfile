FROM php:7.4.15-apache

RUN apt-get update

# 1. development packages
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    iputils-ping \
    libonig-dev \
    g++

# Install xDebug
RUN mkdir /debug /debug/xdebug && \
    curl https://xdebug.org/files/xdebug-2.9.8.tgz --output /debug/xdebug-2.9.8.tgz && \
    tar zxvf /debug/xdebug-2.9.8.tgz -C /debug/xdebug && \
    cd /debug/xdebug/xdebug-2.9.8/ && \
    phpize && \
    ./configure && \
    make && \
    cp modules/xdebug.so /debug/xdebug.so

# 2. apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql \
    zip

EXPOSE 80
EXPOSE 9003

# 5. composer
RUN curl -sS https://getcomposer.org/download/1.10.17/composer.phar --output /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

# 6. we need a user with the same UID/GID with host user
# so when we execute CLI commands, all the host file's ownership remains intact
# otherwise command from inside container will create root-owned files and directories
RUN useradd -G www-data,root -u 1000 -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser

RUN composer global require phpmv/ubiquity-devtools
RUN echo "export PATH=\"\$HOME/.composer/vendor/bin:\$PATH\"" >> .bashrc