#!/bin/bash

if [ ! -f /var/www/html/.env ]; then
    echo ".env not found. Copying .env.example to .env"
    cp /var/www/html/.env.example /var/www/html/.env
fi

if ! grep -q "^APP_KEY=" /var/www/html/.env || grep -q "APP_KEY=$" /var/www/html/.env; then
    echo "Generating APP_KEY..."
    php artisan key:generate
fi

/usr/local/bin/wait-for-it.sh mysql:3306

php artisan migrate --force
php artisan optimize:clear

exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
