#!/usr/bin/env bash
cd /var/www/html
echo "Seeding database (safe to re-run, skips existing rows)..."
php artisan db:seed --force
