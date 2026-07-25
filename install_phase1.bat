@echo off
setlocal
cd /d "%~dp0"
echo This installer must be copied into the root of your KotobaNest project.
if not exist artisan (
  echo ERROR: artisan was not found. Copy the PATCH CONTENT into your project root first.
  pause
  exit /b 1
)
php artisan optimize:clear
php artisan migrate
php artisan db:seed --class=PromoteAdminSeeder
php artisan route:list
npm run build
echo.
echo COMPLETE. Open /dashboard for student and /admin for admin.
pause
