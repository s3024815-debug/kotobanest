#!/usr/bin/env bash
cd /var/www/html
mkdir -p database
touch database/database.sqlite
echo "Running migrations..."
php artisan migrate --force
