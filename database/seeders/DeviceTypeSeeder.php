<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeviceType;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceType::create([
            'name' => 'ZKTeco',
            'description' => 'ZKTeco biometric devices',
        ]);

        DeviceType::create([
            'name' => 'Suprema',
            'description' => 'Suprema biometric devices',
        ]);

        DeviceType::create([
            'name' => 'HID',
            'description' => 'HID card readers',
        ]);

        DeviceType::create([
            'name' => 'Tiposoi',
            'description' => 'Tiposoi biometric devices',
        ]);

        DeviceType::create([
            'name' => 'Hikvision',
            'description' => 'Hikvision biometric devices',
        ]);
    }
}
