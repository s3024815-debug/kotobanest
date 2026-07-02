KotobaNest Kanji v7

Copy all files into:
C:\Users\akash\kotobanest_final\

Replace files when asked.

Open KANJI_CSS_APPEND.txt and copy its CSS to the bottom of:
C:\Users\akash\kotobanest_final\resources\css\app.css

Then run:
cd C:\Users\akash\kotobanest_final
php artisan migrate
php artisan optimize:clear

Open:
http://127.0.0.1:8000/kanji
http://127.0.0.1:8000/admin/kanji
