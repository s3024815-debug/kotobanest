<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PromoteAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 's3024815@surugadai.ac.jp');

        User::where('email', $email)->update([
            'role' => 'super_admin',
            'status' => 'active',
        ]);
    }
}
