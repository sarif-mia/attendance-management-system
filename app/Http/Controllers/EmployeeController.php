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
        return view('admin.employee')->with(['employees' => Employee::all(), 'schedules' => Schedule::all()]);
    }

    public function store(EmployeeRec $request)
    {
        $request->validated();

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->pin_code = bcrypt($request->pin_code);
        $employee->device_type_id = $request->device_type_id;
        $employee->save();

        if ($request->schedule) {
            $schedule = Schedule::whereSlug($request->schedule)->first();
            $employee->schedules()->attach($schedule);
        }

        // $role = Role::whereSlug('emp')->first();
        // $employee->roles()->attach($role);

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
