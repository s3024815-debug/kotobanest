#!/usr/bin/env bash
cd /var/www/html
if [ -f "public/fonts/KanjiStrokeOrders.ttf" ]; then
    echo "Stroke order font already present, skipping."
else
    echo "Downloading stroke order font (first run only, needs internet)..."
    php artisan font:import-stroke-order || echo "Font import failed, will retry on next deploy."
fi
