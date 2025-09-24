@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Add New Employee</h2>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Temporary Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="pin_code">Pin Code</label>
            <input type="password" class="form-control" id="pin_code" name="pin_code" required>
        </div>
        <div class="form-group">
            <label for="device_type">Device Type</label>
            <select class="form-control" id="device_type" name="device_type_id">
                <option value="">Select Device Type</option>
                @foreach(\App\Models\DeviceType::all() as $deviceType)
                    <option value="{{ $deviceType->id }}">{{ $deviceType->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>
@endsection

@section('script')
<script>
// Password toggle functionality
document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.className = 'fa fa-eye-slash';
    } else {
        passwordField.type = 'password';
        eyeIcon.className = 'fa fa-eye';
    }
});
</script>
@endsection
