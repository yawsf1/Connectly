#!/bin/bash
chmod -R 777 /var/www/storage /var/www/bootstrap/cache
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan storage:link --force
php-fpm -D
nginx -g 'daemon off;'
