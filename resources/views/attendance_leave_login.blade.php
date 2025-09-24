@extends('layouts.master')

@section('title', 'Assign Leave')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assign Leave</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('leave.assign') }}">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <select class="form-control" id="employee_id" name="employee_id" required>
                                <option value="">Select Employee</option>
                                <!-- Add options for employees here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave_type">Leave Type</label>
                            <select class="form-control" id="leave_type" name="leave_type" required>
                                <option value="">Select Leave Type</option>
                                <option value="annual">Annual Leave</option>
                                <option value="sick">Sick Leave</option>
                                <option value="maternity">Maternity Leave</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
