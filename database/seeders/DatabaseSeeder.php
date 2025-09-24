<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Hash;
use Spatie\Permission\Traits\HasRoles;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Get existing roles or create them if they don't exist
        $adminRole = Role::where('slug', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create([
                'slug' => 'admin',
                'name' => 'Administrator',
            ]);
        }

        $employeeRole = Role::where('slug', 'employee')->first();
        if (!$employeeRole) {
            $employeeRole = Role::create([
                'slug' => 'employee',
                'name' => 'Employee',
            ]);
        }

        // Run the user seeder to create all users
        $this->call(UserSeeder::class);

        // Run the device type seeder
        $this->call(DeviceTypeSeeder::class);
    }
}
