#!/bin/sh
set -e

mkdir -p storage/framework/cache \
    storage/framework/views \
    storage/framework/sessions \
    storage/logs \
    bootstrap/cache

chmod -R 775 storage bootstrap/cache

# .env yoxdursa .env.example-dən kopyala
if [ ! -f .env ]; then
    cp .env.example .env
fi

# APP_KEY boşdursa yarat
if grep -q "^APP_KEY=$" .env; then
    php artisan key:generate --force
fi

php artisan optimize:clear || true
php artisan horizon:publish || true
# Supervisor işlət (queue worker üçün)
supervisord -c /etc/supervisor/supervisord.conf &

exec php-fpm