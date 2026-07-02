KotobaNest Homepage 2.0

Copy into:
C:\Users\akash\kotobanest_final\

Replace:
resources/views/welcome.blade.php

Then open HOMEPAGE_2_CSS_APPEND.txt and copy all CSS to the bottom of:
C:\Users\akash\kotobanest_final\resources\css\app.css

Run:
cd C:\Users\akash\kotobanest_final
npm run build
php artisan optimize:clear
php artisan serve

After test:
git add .
git commit -m "feat: homepage 2.0 redesign"
git push
