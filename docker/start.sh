#!/bin/bash
php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan storage:link --force

# Replace port in nginx config
sed -i "s/8080/${PORT:-8080}/g" /etc/nginx/sites-available/default

php-fpm -D
nginx -g 'daemon off;'