#!/bin/sh

# install laravel
# https://github.com/laravel/laravel.git

# config composer dir
mkdir /composer \
&& cp composer.phar /composer/composer \
&& chmod 775 /composer/composer

# instal packages laravel
# generate key
# start migration
# and tests
php composer.phar install \
&& php artisan key:generate \
&& php artisan migrate:refresh --seed
&& php artisan test
