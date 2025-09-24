<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        $admin = User::firstOrCreate([
            'email' => 'sarif@lovegenbd.com',
        ], [
            'name' => 'Admin Sarif',
            'password' => Hash::make('adminpassword'),
        ]);

        // Create roles
        $adminRole = Role::firstOrCreate(['slug' => 'admin'], ['name' => 'Admin']);
        $supervisorRole = Role::firstOrCreate(['slug' => 'supervisor'], ['name' => 'Supervisor']);
        $employeeRole = Role::firstOrCreate(['slug' => 'employee'], ['name' => 'Employee']);

        // Assign admin role
        $admin->roles()->sync([$adminRole->id]);

        // Create some additional users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email'],
            ], $userData);

            // Assign employee role if exists, otherwise assign admin role
            $employeeRole = Role::where('slug', 'employee')->first();
            if ($employeeRole) {
                $user->roles()->sync([$employeeRole->id]);
            } else {
                // If no employee role, assign admin role
                $user->roles()->sync([$adminRole->id]);
            }
        }

        $this->command->info('Users created successfully!');
        $this->command->info('Admin: sarif@lovegenbd.com / adminpassword');
        $this->command->info('Users: john@example.com, jane@example.com, bob@example.com, alice@example.com / password123');
    }
}
