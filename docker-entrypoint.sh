#!/bin/sh

# install laravel
# https://github.com/laravel/laravel.git

# http server
php composer.phar install && php artisan key:generate && php artisan serve --host=0.0.0.0 --port=8080
