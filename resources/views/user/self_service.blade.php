@extends('layouts.master')

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Employee Self-Service</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">My HR Portal</li>
     </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">My Leave Requests</h4>
                <ul class="list-group">
                    @foreach($leaves as $leave)
                    <li class="list-group-item">
                        {{ $leave->type }} - {{ $leave->status }} ({{ $leave->created_at->format('d M Y') }})
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">My Payroll</h4>
                <ul class="list-group">
                    @foreach($payrolls as $payroll)
                    <li class="list-group-item">
                        {{ $payroll->month }} - {{ $payroll->amount }} BDT
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">My Attendance</h4>
                <a href="{{ route('selfservice.attendance.download') }}" class="btn btn-outline-info mb-2">Download Attendance Report</a>
                <ul class="list-group">
                    @foreach($attendance as $att)
                    <li class="list-group-item">
                        {{ $att->attendance_date }} - {{ $att->status == 1 ? 'On Time' : 'Late' }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
