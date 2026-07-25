KOTOBANEST ROLE-BASED ADMIN + UNIQUE STUDENT ACCOUNT PATCH

WHAT THIS ADDS
- Secure /admin area for admin and super_admin only
- Unique account page for every registered user
- Student dashboard separate from admin panel
- Admin user search, role change, suspend and delete controls
- Mobile-responsive admin and student layouts
- Profile fields: username, country, native language, JLPT, bio, XP, streak

INSTALL
1. Make a backup of your project.
2. Copy the app, database, resources and routes folders into the KotobaNest project root.
3. Merge USER_MODEL_CHANGES.txt into app/Models/User.php.
4. In .env add:
   ADMIN_EMAIL=s3024815@surugadai.ac.jp
5. Run install_phase1.bat from the project root, or run:
   php artisan optimize:clear
   php artisan migrate
   php artisan db:seed --class=PromoteAdminSeeder
   npm run build

PAGES
Student: /dashboard and /account
Admin: /admin and /admin/users

IMPORTANT
This patch is based on the current public routes/web.php in the GitHub repository on 2026-07-21. It preserves the existing Lessons, Vocabulary, Kanji, Quiz, Favorites, Notes and Profile routes while securing the admin routes.
