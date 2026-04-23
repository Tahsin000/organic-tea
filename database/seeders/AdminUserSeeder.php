<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@organictea.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@organictea.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );
    }
}
