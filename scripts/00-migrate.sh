#!/usr/bin/env bash
cd /var/www/html
mkdir -p database
touch database/database.sqlite
chmod 666 database/database.sqlite
chmod 777 database
chmod -R 777 storage bootstrap/cache 2>/dev/null || true
chown -R nginx:nginx database/database.sqlite database storage bootstrap/cache 2>/dev/null || \
  chown -R www-data:www-data database/database.sqlite database storage bootstrap/cache 2>/dev/null || \
  true
echo "Running migrations..."
php artisan migrate --force
