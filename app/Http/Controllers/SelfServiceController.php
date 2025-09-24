<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Payroll;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class SelfServiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $leaves = Leave::where('emp_id', $user->id)->orderBy('created_at', 'desc')->get();
        $payrolls = Payroll::where('emp_id', $user->id)->orderBy('created_at', 'desc')->get();
        $attendance = Attendance::where('emp_id', $user->id)->orderBy('attendance_date', 'desc')->limit(30)->get();
        return view('user.self_service', compact('leaves', 'payrolls', 'attendance'));
    }

    public function downloadAttendance()
    {
        $user = Auth::user();
        $attendance = Attendance::where('emp_id', $user->id)->orderBy('attendance_date', 'desc')->get();
        $csv = "Date,Status,Check-in,Check-out\n";
        foreach ($attendance as $att) {
            $csv .= "{$att->attendance_date},{$att->status},{$att->check_in},{$att->check_out}\n";
        }
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=attendance.csv');
    }
}
