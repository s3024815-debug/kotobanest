KotobaNest Organized User Course Dashboard Patch

What changes:
- N5 to N1 are no longer displayed together.
- User selects one JLPT level from a dropdown.
- Category buttons filter Vocabulary, Kanji, Grammar, Reading and Listening.
- Search filters levels and categories.
- No database migration is required.

Install:
1. Extract this ZIP.
2. Copy the app and resources folders into C:\Users\akash\kotobanest_final
3. Choose "Replace the files in the destination".
4. Run:
   php artisan optimize:clear
   npm run build
   php artisan serve
5. Open:
   http://127.0.0.1:8000/courses
