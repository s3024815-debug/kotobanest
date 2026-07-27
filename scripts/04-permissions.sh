#!/usr/bin/env bash
cd /var/www/html
echo "Re-asserting writable permissions (final safety pass)..."
chmod -R 777 database
chmod -R 777 storage bootstrap/cache 2>/dev/null || true
find database -type f -exec chmod 666 {} \;
find database -type d -exec chmod 777 {} \;
echo "Current database/ permissions:"
ls -la database/
