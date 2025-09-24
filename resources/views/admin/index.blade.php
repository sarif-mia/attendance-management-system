@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Attendance Management System</li>
     </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Employees</h6>
                <h4 class="font-500">{{$data[0]}}</h4>
                <a href="{{ route('employees.index') }}" class="text-white-50">View All</a>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-success text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Attendance</h6>
                <h4 class="font-500">{{$data[1]}}</h4>
                <a href="{{ route('attendance') }}" class="text-white-50">View</a>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-warning text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Leave</h6>
                <h4 class="font-500">{{ $leaveCount ?? 0 }}</h4>
                <a href="{{ route('leave') }}" class="text-white-50">View</a>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-info text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Expenses</h6>
                <h4 class="font-500">{{ $expenseCount ?? 0 }}</h4>
                <a href="{{ route('expense.index') }}" class="text-white-50">View</a>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-danger text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Tasks</h6>
                <h4 class="font-500">{{ $taskCount ?? 0 }}</h4>
                <a href="{{ route('task.index') }}" class="text-white-50">View</a>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6 mb-3">
        <div class="card mini-stat bg-secondary text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">Payroll</h6>
                <h4 class="font-500">{{ $payrollCount ?? 0 }}</h4>
                <a href="#" class="text-white-50">View</a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">Attendance Trend</h4>
                <div id="attendance-trend-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">Leave Statistics</h4>
                <div id="leave-stats-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">Device Activity</h4>
                <div id="device-activity-chart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-5">Recent Attendance</h4>
                <div class="table-responsive">
                <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Employee</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentAttendance as $att)
                                                    <tr>
                                                        <td>{{ $att->employee->name ?? 'N/A' }}</td>
                                                        <td>{{ $att->attendance_date }}</td>
                                                        <td>
                                                            @if($att->status == 1)
                                                                <span class="badge badge-success">On Time</span>
                                                            @else
                                                                <span class="badge badge-danger">Late</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title mb-4">Quick Actions</h4>
                                        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-block mb-2">Add Employee</a>
                                        <a href="{{ route('attendance') }}" class="btn btn-success btn-block mb-2">Mark Attendance</a>
                                        <a href="{{ route('leave') }}" class="btn btn-warning btn-block mb-2">Request Leave</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title mb-4">Notifications Center</h4>
                                        <ul class="list-group mb-3">
                                            @foreach($notifications as $notification)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $notification->title }}</span>
                                                    <span class="badge badge-{{ $notification->is_read ? 'secondary' : 'primary' }}">{{ $notification->is_read ? 'Read' : 'New' }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('notification.index') }}" class="btn btn-outline-info btn-block">View All Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script>
// Attendance Trend Chart
new Chartist.Line('#attendance-trend-chart', {
    labels: {!! json_encode($attendanceTrend['labels'] ?? []) !!},
    series: [{!! json_encode($attendanceTrend['series'] ?? []) !!}]
}, {
    fullWidth: true,
    chartPadding: { right: 40 },
    plugins: [Chartist.plugins.tooltip()]
});

// Leave Statistics Chart
new Chartist.Pie('#leave-stats-chart', {
    labels: {!! json_encode($leaveStats['labels'] ?? []) !!},
    series: {!! json_encode($leaveStats['series'] ?? []) !!}
}, {
    plugins: [Chartist.plugins.tooltip()]
});

// Device Activity Chart
new Chartist.Bar('#device-activity-chart', {
    labels: {!! json_encode($deviceActivity['labels'] ?? []) !!},
    series: [{!! json_encode($deviceActivity['series'] ?? []) !!}]
}, {
    plugins: [Chartist.plugins.tooltip()]
});
</script>
@endsection