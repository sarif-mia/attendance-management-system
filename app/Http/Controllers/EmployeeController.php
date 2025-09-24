<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Schedule;
use App\Http\Requests\EmployeeRec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function create()
    {
        return view('admin.create_employee');
    }

    public function index()
    {
        return view('admin.employee')->with([
            'employees' => Employee::all(), 
            'schedules' => Schedule::all(),
            'deviceTypes' => \App\Models\DeviceType::all(),
        ]);
    }

    public function store(EmployeeRec $request)
    {
        $request->validated();

        // Generate a temporary password if not provided
        $tempPassword = $request->password ?? \Str::random(8);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->pin_code = bcrypt($request->pin_code);
        // Save temporary password
        $employee->password = bcrypt($tempPassword);
        $employee->must_change_password = true;
        $employee->save();

    // Optionally, send email to employee with one-time password
    // \Mail::to($employee->email)->send(new \App\Mail\EmployeeWelcomeMail($employee, $request->password));

        // Attach schedule if selected
        if ($request->schedule) {
            $schedule = Schedule::whereSlug($request->schedule)->first();
            if ($schedule) {
                $employee->schedules()->attach($schedule);
            }
        }

        // Assign role if provided, otherwise assign default 'emp' role
        if ($request->role_id) {
            $employee->roles()->attach($request->role_id);
        } else {
            $defaultRole = Role::whereSlug('emp')->first();
            if ($defaultRole) {
                $employee->roles()->attach($defaultRole->id);
            }
        }

        Session::flash('success', 'Employee Record has been created successfully!');

        return redirect()->route('employees.index')->with('success');
    }

    public function update(EmployeeRec $request, Employee $employee)
    {
        $request->validated();

        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->pin_code = bcrypt($request->pin_code);
        $employee->save();

        if ($request->schedule) {
            $employee->schedules()->detach();
            $schedule = Schedule::whereSlug($request->schedule)->first();
            $employee->schedules()->attach($schedule);
        }

        // Sync role if provided
        if ($request->role_id) {
            $employee->roles()->sync([$request->role_id]);
        }

        Session::flash('success', 'Employee Record has been Updated successfully!');

        return redirect()->route('employees.index')->with('success');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        Session::flash('success', 'Employee Record has been Deleted successfully!');
        return redirect()->route('employees.index')->with('success');
    }
}
