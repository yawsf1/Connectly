#!/bin/bash
set -e

sed -i "s/RAILWAY_PORT_PLACEHOLDER/${PORT}/g" /etc/nginx/sites-available/default

php artisan migrate --force
php artisan config:clear
php artisan cache:clear
php artisan storage:link --force

# Run php-fpm in the foreground (no -D) but in the background of this script
# so its stdout/stderr remain attached to the container logs.
php-fpm --nodaemonize &
PHP_FPM_PID=$!

# If php-fpm exits for any reason, kill nginx and exit with its status
# so the container stops and the error is visible in deploy logs.
trap "echo 'php-fpm exited'; kill $PHP_FPM_PID 2>/dev/null; exit 1" EXIT

# Keep nginx in the foreground. If nginx exits, the trap above fires.
nginx -g 'daemon off;'