<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Task;
use App\Models\Notification;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $attendanceCount = Attendance::where('emp_id', $user->id)->count();
        $leaveCount = Leave::where('emp_id', $user->id)->count();
        $taskCount = Task::where('emp_id', $user->id)->count();
        $recentAttendance = Attendance::where('emp_id', $user->id)
            ->orderBy('attendance_date', 'desc')
            ->limit(10)
            ->get();
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        return view('user.index', compact('attendanceCount', 'leaveCount', 'taskCount', 'recentAttendance', 'notifications'));
    }
}
