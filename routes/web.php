<?php

// Security Enhancements: Two-Factor Authentication (admin)
Route::group(['middleware' => ['auth:web', 'Role'], 'roles' => ['admin']], function () {
    Route::get('/admin/2fa', function () {
        return view('admin.2fa');
    })->name('admin.2fa');
    // Add logic for 2FA setup/verification as needed
});
// Employee Self-Service
Route::group(['middleware' => ['auth:employee', 'Role'], 'roles' => ['user']], function () {
    Route::get('/self-service', '\App\Http\Controllers\SelfServiceController@index')->name('selfservice.index');
    Route::get('/self-service/attendance/download', '\App\Http\Controllers\SelfServiceController@downloadAttendance')->name('selfservice.attendance.download');
});
// Device Health & Status
Route::group(['middleware' => ['auth:web', 'Role'], 'roles' => ['admin']], function () {
    Route::get('/device-health', '\App\Http\Controllers\DeviceHealthController@index')->name('device.health');
});
// Audit Logs
Route::group(['middleware' => ['auth:web', 'Role'], 'roles' => ['admin']], function () {
    Route::get('/audit-logs', '\App\Http\Controllers\AuditLogController@index')->name('audit.logs');
});
// Role Management
Route::group(['middleware' => ['auth:web', 'Role'], 'roles' => ['admin']], function () {
    Route::resource('/roles', '\App\Http\Controllers\RoleController');
});
// Profile & Settings
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', '\App\Http\Controllers\ProfileController@index')->name('profile.index');
    Route::post('/profile/update', '\App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::post('/profile/password', '\App\Http\Controllers\ProfileController@password')->name('profile.password');
});



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerDevicesControlller;
use App\Jobs\ClearAttendanceJob;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('attended/{user_id}', '\App\Http\Controllers\AttendanceController@attended' )->name('attended');
Route::get('attended-before/{user_id}', '\App\Http\Controllers\AttendanceController@attendedBefore' )->name('attendedBefore');
// Removed default Auth::routes to disable /login. Use only custom admin and user login routes.

// Admin Authentication Routes
Route::get('/admin/login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'App\Http\Controllers\Auth\LoginController@adminLogin');

Route::get('/user', function () {
    return redirect()->route('login');
});


Route::get('/user/login', 'App\Http\Controllers\Auth\LoginController@showUserLoginForm')->name('login');
Route::post('/user/login', 'App\Http\Controllers\Auth\LoginController@userLogin');

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    Route::resource('/employees', '\App\Http\Controllers\EmployeeController');
    Route::get('/attendance', '\App\Http\Controllers\AttendanceController@index')->name('attendance');
  
    Route::get('/latetime', '\App\Http\Controllers\AttendanceController@indexLatetime')->name('indexLatetime');
    Route::get('/leave', '\App\Http\Controllers\LeaveController@index')->name('leave');
    Route::get('/overtime', '\App\Http\Controllers\LeaveController@indexOvertime')->name('indexOvertime');

    Route::get('/admin', '\App\Http\Controllers\AdminController@index')->name('admin');

    Route::resource('/schedule', '\App\Http\Controllers\ScheduleController');

    Route::get('/check', '\App\Http\Controllers\CheckController@index')->name('check');
    Route::get('/sheet-report', '\App\Http\Controllers\CheckController@sheetReport')->name('sheet-report');
    Route::post('check-store','\App\Http\Controllers\CheckController@CheckStore')->name('check_store');
    
    // Fingerprint Devices
    Route::resource('/finger_device', '\App\Http\Controllers\BiometricDeviceController');

    Route::delete('finger_device/destroy', '\App\Http\Controllers\BiometricDeviceController@massDestroy')->name('finger_device.massDestroy');
    Route::get('finger_device/{fingerDevice}/employees/add', '\App\Http\Controllers\BiometricDeviceController@addEmployee')->name('finger_device.add.employee');
    Route::get('finger_device/{fingerDevice}/get/attendance', '\App\Http\Controllers\BiometricDeviceController@getAttendance')->name('finger_device.get.attendance');
    // Temp Clear Attendance route
    Route::get('finger_device/clear/attendance', function () {
        $midnight = \Carbon\Carbon::createFromTime(23, 50, 00);
        $diff = now()->diffInMinutes($midnight);
        dispatch(new ClearAttendanceJob())->delay(now()->addMinutes($diff));
        toast("Attendance Clearance Queue will run in 11:50 P.M!", "success");

        return back();
    })->name('finger_device.clear.attendance');
    
        // Admin-only features
        Route::get('/notice-board', '\App\Http\Controllers\NoticeController@index')->name('notice.index');
        Route::get('/notice-board/create', '\App\Http\Controllers\NoticeController@create')->name('notice.create');
        Route::post('/notice-board', '\App\Http\Controllers\NoticeController@store')->name('notice.store');
        Route::get('/notice-board/{notice}/edit', '\App\Http\Controllers\NoticeController@edit')->name('notice.edit');
        Route::put('/notice-board/{notice}', '\App\Http\Controllers\NoticeController@update')->name('notice.update');
        Route::delete('/notice-board/{notice}', '\App\Http\Controllers\NoticeController@destroy')->name('notice.destroy');
        Route::get('/expenses', '\App\Http\Controllers\ExpenseController@index')->name('expense.index');
        Route::get('/expenses/create', '\App\Http\Controllers\ExpenseController@create')->name('expense.create');
        Route::post('/expenses', '\App\Http\Controllers\ExpenseController@store')->name('expense.store');
        Route::get('/tasks', '\App\Http\Controllers\TaskController@index')->name('task.index');
        Route::get('/tasks/create', '\App\Http\Controllers\TaskController@create')->name('task.create');
        Route::post('/tasks', '\App\Http\Controllers\TaskController@store')->name('task.store');
});
// User dashboard (limited features)
Route::group(['middleware' => ['auth:employee', 'Role'], 'roles' => ['user']], function () {
    Route::get('/user', '\App\Http\Controllers\UserDashboardController@index')->name('user.dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    // Authentication
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    // Notifications
    Route::get('/notifications', '\App\Http\Controllers\NotificationController@index')->name('notification.index');
    Route::post('/notifications', '\App\Http\Controllers\NotificationController@store')->name('notification.store');
    Route::post('/notifications/read/{id}', '\App\Http\Controllers\NotificationController@markRead')->name('notification.read');
});

// Leave assignment routes
Route::get('/leave/assign', '\App\Http\Controllers\LeaveController@assign')->name('leave.login');
Route::post('/leave/assign', '\App\Http\Controllers\LeaveController@assignPost')->name('leave.assign');


// Debug route - remove in production
Route::get('/whoami', function () {
    $webUser = auth()->user();
    $employeeUser = auth()->guard('employee')->check() ? auth()->guard('employee')->user() : null;

    return response()->json([
        'web_guard_authenticated' => auth()->check(),
        'web_user' => $webUser ? [
            'id' => $webUser->id ?? null,
            'email' => $webUser->email ?? null,
            'roles' => method_exists($webUser, 'roles') ? $webUser->roles()->pluck('slug') : null,
        ] : null,
        'employee_guard_authenticated' => auth()->guard('employee')->check(),
        'employee_user' => $employeeUser ? [
            'id' => $employeeUser->id ?? null,
            'email' => $employeeUser->email ?? null,
            'roles' => method_exists($employeeUser, 'roles') ? $employeeUser->roles()->pluck('slug') : null,
        ] : null,
    ]);
});

// Route::get('{any}', 'App\http\controllers\VeltrixController@index');