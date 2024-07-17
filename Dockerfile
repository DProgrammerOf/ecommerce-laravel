FROM php:8.3-cli

# git
RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get -y install zip
RUN apt-get -y install libgmp-dev

# xdebug
COPY 90-xdebug.ini "${PHP_INI_DIR}/conf.d/90-xdebug.ini"
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install gmp
RUN docker-php-ext-install ftp
RUN docker-php-ext-install pdo pdo_mysql

# app
WORKDIR /app

# entrypoint.sh
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]
