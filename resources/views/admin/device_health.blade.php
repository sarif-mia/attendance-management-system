@extends('layouts.master')

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Device Health & Status</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Biometric Device Monitoring</li>
     </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>IP Address</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($health as $device)
                <tr>
                    <td>{{ $device['name'] }}</td>
                    <td>{{ $device['ip'] }}</td>
                    <td>{{ $device['serial'] }}</td>
                    <td>
                        <span class="badge badge-{{ $device['status'] == 'Online' ? 'success' : 'danger' }}">{{ $device['status'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
