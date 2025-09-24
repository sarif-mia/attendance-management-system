<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FixAdminRoleSeeder extends Seeder
{
    public function run()
    {
        // Ensure 'admin' role exists
        $roleId = DB::table('roles')->updateOrInsert(
            ['slug' => 'admin'],
            [
                'slug' => 'admin',
                'name' => 'Administrator',
                'permissions' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Get admin role id
        $role = DB::table('roles')->where('slug', 'admin')->first();
        $user = DB::table('users')->where('email', 'sarif@lovegenbd.com')->first();
        if ($role && $user) {
            // Assign admin role to user
            DB::table('role_users')->updateOrInsert(
                ['user_id' => $user->id, 'role_id' => $role->id],
                ['user_id' => $user->id, 'role_id' => $role->id]
            );
        }
    }
}
