#!/usr/bin/env bash
cd /var/www/html
COUNT=$(php artisan tinker --execute="echo \App\Models\DictionaryEntry::count();" 2>/dev/null | tail -1)
if [ "$COUNT" -gt "0" ] 2>/dev/null; then
    echo "Dictionary already has $COUNT entries, skipping import."
else
    echo "Importing JMDict dictionary (first run only, needs internet)..."
    php artisan dictionary:import || echo "Dictionary import failed, will retry on next deploy."
fi
