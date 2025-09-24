<?php

namespace App\Http\Controllers;

use App\Models\FingerDevices;
use Illuminate\Http\Request;

class DeviceHealthController extends Controller
{
    public function index()
    {
        $devices = FingerDevices::all();
        $health = [];
        foreach ($devices as $device) {
            // Simulate health check (replace with real API if available)
            $status = $device->ip ? 'Online' : 'Offline';
            $health[] = [
                'name' => $device->name,
                'ip' => $device->ip,
                'serial' => $device->serialNumber,
                'status' => $status,
            ];
        }
        return view('admin.device_health', compact('health'));
    }
}
