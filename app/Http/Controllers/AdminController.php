<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;


class AdminController extends Controller
{

 
    public function index()
    {
        //Dashboard statistics 
        $totalEmp =  count(Employee::all());
        $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
        $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
        $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());
            
        if($AllAttendance > 0){
                $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
            }else {
                $percentageOntime = 0 ;
            }
        
    $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];
    $recentAttendance = Attendance::with('employee')->orderBy('attendance_date', 'desc')->limit(10)->get();

    $leaveCount = \App\Models\Leave::count();
    $expenseCount = \App\Models\Expense::count();
    $taskCount = \App\Models\Task::count();
    $payrollCount = \App\Models\Payroll::count();

    // Attendance Trend (last 7 days)
    $trendLabels = [];
    $trendSeries = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $trendLabels[] = date('M d', strtotime($date));
        $trendSeries[] = Attendance::whereAttendance_date($date)->count();
    }
    $attendanceTrend = [
        'labels' => $trendLabels,
        'series' => $trendSeries,
    ];

    // Leave Statistics (by type)
    $leaveTypes = \App\Models\Leave::select('type')->distinct()->pluck('type');
    $leaveStatsLabels = $leaveTypes->toArray();
    $leaveStatsSeries = [];
    foreach ($leaveTypes as $type) {
        $leaveStatsSeries[] = \App\Models\Leave::where('type', $type)->count();
    }
    $leaveStats = [
        'labels' => $leaveStatsLabels,
        'series' => $leaveStatsSeries,
    ];

    // Device Activity (last 7 days)
    $deviceLabels = [];
    $deviceSeries = [];
    $devices = \App\Models\FingerDevices::all();
    foreach ($devices as $device) {
        $deviceLabels[] = $device->name;
        $deviceSeries[] = Attendance::where('device_id', $device->id)->whereBetween('attendance_date', [date('Y-m-d', strtotime('-6 days')), date('Y-m-d')])->count();
    }
    $deviceActivity = [
        'labels' => $deviceLabels,
        'series' => $deviceSeries,
    ];

    $notifications = \App\Models\Notification::orderBy('created_at', 'desc')->limit(10)->get();
    return view('admin.index')->with([
        'data' => $data,
        'recentAttendance' => $recentAttendance,
        'leaveCount' => $leaveCount,
        'expenseCount' => $expenseCount,
        'taskCount' => $taskCount,
        'payrollCount' => $payrollCount,
        'attendanceTrend' => $attendanceTrend,
        'leaveStats' => $leaveStats,
        'deviceActivity' => $deviceActivity,
        'notifications' => $notifications,
    ]);
    }

}
