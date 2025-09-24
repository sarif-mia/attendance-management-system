@extends('layouts.master')

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">User Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to AMS</li>
     </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card mini-stat bg-success text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">My Attendance</h6>
                <h4 class="font-500">{{ $attendanceCount ?? 0 }}</h4>
                <a href="{{ route('attended', auth()->user()->id) }}" class="text-white-50">View Details</a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card mini-stat bg-warning text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">My Leave</h6>
                <h4 class="font-500">{{ $leaveCount ?? 0 }}</h4>
                <a href="{{ route('leave') }}" class="text-white-50">View Details</a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-3">
        <div class="card mini-stat bg-info text-white">
            <div class="card-body">
                <h6 class="font-14 text-uppercase">My Tasks</h6>
                <h4 class="font-500">{{ $taskCount ?? 0 }}</h4>
                <a href="{{ route('task.index') }}" class="text-white-50">View Details</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-5">My Recent Attendance</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAttendance as $attendance)
                        <tr>
                            <td>{{ $attendance->attendance_date }}</td>
                            <td>{{ $attendance->status }}</td>
                            <td>{{ $attendance->check_in }}</td>
                            <td>{{ $attendance->check_out }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-5">Notifications</h4>
                <ul class="list-group">
                    @foreach($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $notification->title }}
                        <span class="badge badge-primary badge-pill">{{ $notification->is_read ? 'Read' : 'New' }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
