<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\FingerDevices;
use App\Helpers\FingerHelper;
use App\Models\Leave;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;

class LeaveController extends Controller
{
    public function index()
    {
        return view('admin.leave')->with(['leaves' => Leave::all()]);
    }

    public function indexOvertime()
    {
        return view('admin.overtime')->with(['overtimes' => Overtime::all()]);
    }


    // public static function overTime(Employee $employee)
    // {
    //     $current_t = new DateTime(date('H:i:s'));
    //     $start_t = new DateTime($employee->schedules->first()->time_out);
    //     $difference = $start_t->diff($current_t)->format('%H:%I:%S');

    //     $overtime = new Overtime();
    //     $overtime->emp_id = $employee->id;
    //     $overtime->duration = $difference;
    //     $overtime->overtime_date = date('Y-m-d');
    //     $overtime->save();
    // }
    public static function overTimeDevice($att_dateTime, Employee $employee)
    {
        
            $attendance_time =new DateTime($att_dateTime);
            $checkout = new DateTime($employee->schedules->first()->time_out);
            $difference = $checkout->diff($attendance_time)->format('%H:%I:%S');

            $overtime = new Overtime();
            $overtime->emp_id = $employee->id;
            $overtime->duration = $difference;
            $overtime->overtime_date = date('Y-m-d', strtotime($att_dateTime));
            $overtime->save();
        
    }

    public function assign()
    {
        return view('attendance_leave_login');
    }

    public function assignPost()
    {
        // Handle the POST request for assigning leave
        // Add your logic here, e.g., validate and save leave data
        return redirect()->back()->with('success', 'Leave assigned successfully');
    }
}
