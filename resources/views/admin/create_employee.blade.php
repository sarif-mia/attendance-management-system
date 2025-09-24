@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Add New Employee</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
            <label for="password">Temporary Password (Optional)</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Leave empty to auto-generate">
                <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>
            <small class="form-text text-muted">If left empty, a secure temporary password will be generated.</small>
        </div>
        <div class="form-group">
            <label for="pin_code">Pin Code (for Attendance)</label>
            <div class="input-group">
                <input type="password" class="form-control" id="pin_code" name="pin_code" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="togglePin" style="cursor: pointer;">
                        <i class="fa fa-eye" id="pinEyeIcon"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="schedule">Work Schedule</label>
            <select class="form-control" id="schedule" name="schedule">
                <option value="">Select Schedule</option>
                @foreach(\App\Models\Schedule::all() as $schedule)
                    <option value="{{ $schedule->slug }}">{{ $schedule->time_in }} - {{ $schedule->time_out }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Optional - You can assign a schedule later</small>
        </div>

        <div class="form-group">
            <label for="role">Assign Role</label>
            <select class="form-control" id="role" name="role_id">
                <option value="">Select Role (default: Employee)</option>
                @foreach(\App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}">{{ $role->name }} ({{ $role->slug }})</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Assign a role to control access. If left empty, default employee role will be assigned.</small>
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
