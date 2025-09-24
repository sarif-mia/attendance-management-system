<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'sarif@lovegenbd.com'],
            [
                'name' => 'Admin',
                'email' => 'sarif@lovegenbd.com',
                'password' => Hash::make('adminpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
