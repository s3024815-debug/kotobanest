# KotobaNest Admin Curriculum Manager

This patch adds a visual admin manager for:

- Courses (N5–N1)
- Five skill sections
- Modules
- Lessons
- Publish/draft state
- Estimated study time and XP
- Up/down curriculum ordering

## Install

Copy the patch contents into the root of `C:\Users\akash\kotobanest_final` and replace matching files.

Then run:

```cmd
cd C:\Users\akash\kotobanest_final
php artisan optimize:clear
php artisan route:list
npm run build
php artisan serve
```

Open:

`http://127.0.0.1:8000/admin/curriculum`

No new migration is required for this patch. The earlier curriculum migration must already be installed.
