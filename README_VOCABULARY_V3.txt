KotobaNest Vocabulary System v3

Copy all folders/files into:
C:\Users\akash\kotobanest_final\

Replace files when asked.

IMPORTANT:
Open VOCABULARY_CSS_APPEND.txt and copy the CSS to the bottom of:
C:\Users\akash\kotobanest_final\resources\css\app.css

Then run:
cd C:\Users\akash\kotobanest_final
php artisan migrate
php artisan optimize:clear

Keep running:
npm run dev
php artisan serve

Open:
http://127.0.0.1:8000/vocabulary

Admin:
http://127.0.0.1:8000/admin/vocabulary
