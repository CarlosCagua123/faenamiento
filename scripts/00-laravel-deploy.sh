#!/usr/bin/env bash
set -e

echo "▶ Composer install (prod)"
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --working-dir=/var/www/html

echo "▶ Caches"
php artisan config:cache
php artisan route:cache
php artisan view:cache || true

echo "▶ Storage link"
php artisan storage:link || true

echo "▶ Migrate"
php artisan migrate --force

# (Opcional) Seeders al vuelo si quieres un admin por defecto:
# php artisan db:seed --class="Database\\Seeders\\AdminUserSeeder" --force || true

echo "✅ Deploy script OK"
