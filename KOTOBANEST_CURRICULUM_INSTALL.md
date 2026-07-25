# KotobaNest Curriculum System

This update adds an organized N5–N1 curriculum with five sections per course:

- Vocabulary
- Kanji
- Grammar
- Reading
- Listening

It also adds course enrollment/unlock, sequential lesson unlocking, lesson completion, XP rewards and course progress.

## Install on Windows

1. Back up your project folder and SQLite database.
2. Copy the update files into `C:\Users\akash\kotobanest_final` and replace files when asked.
3. Open CMD in the project folder and run:

```cmd
cd C:\Users\akash\kotobanest_final
php artisan migrate
php artisan db:seed --class=CourseCurriculumSeeder
php artisan optimize:clear
npm run build
php artisan serve
```

4. Log in and open:

```text
http://127.0.0.1:8000/courses
```

## Test login created by DatabaseSeeder only

- Email: `test@example.com`
- Password: `password`

Do not run the full `DatabaseSeeder` unless you need the test account. Running `CourseCurriculumSeeder` is safe to repeat because it uses `updateOrCreate`.

## Important

The seeded lessons are curriculum placeholders. Use the admin area to replace each placeholder with complete lesson content.
