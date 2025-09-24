<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /* ...existing code... */

    /**
     * Handle user login POST request.
     */
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        // Get the employee by email
        $employee = \App\Models\Employee::where('email', $request->email)->first();
        
        if (!$employee) {
            return back()->withErrors([
                'email' => 'No employee account found with this email',
            ]);
        }
        
        // Check if passwords match
        if (password_verify($request->password, $employee->password)) {
            auth()->guard('employee')->login($employee);
            return redirect()->intended('/user');
        }
        
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Handle admin login POST request.
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->intended('/admin');
            }
            // If user is not an admin, log them out and return error
            auth()->logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access admin area',
            ]);
        }
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    /**
     * Show the user login form.
     *
     * @return \Illuminate\View\View
     */
    public function showUserLoginForm()
    {
        return view('auth.user_login');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('admin')) {
            return '/admin';
        }
        return '/user';
    }
}