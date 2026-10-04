#!/bin/sh
set -e

cd /var/www

composer install --no-interaction --prefer-dist --optimize-autoloader

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/app/public storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if grep -q "^APP_KEY=$" .env 2>/dev/null; then
    php artisan key:generate --force
fi

php artisan config:clear
php artisan migrate --force
php artisan optimize:clear
php artisan storage:link || true

exec php-fpm
