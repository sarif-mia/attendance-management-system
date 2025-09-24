@extends('layouts.master-blank')

@section('content')

    <div class="wrapper-page">
        <div class="card overflow-hidden account-card mx-3">
            <div class="bg-primary p-4 text-white text-center position-relative">
                <h2 class="font-24 m-b-5">Admin Login</h2>
                <p class="text-white-50 mb-2">Cloud-Based HR & Payroll Solution</p>
                <div id="login-timer" style="font-size:2rem;font-weight:bold;margin-bottom:10px;"></div>
                <a href="{{ route('welcome') }}" class="logo logo-admin">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AMS" style="height:48px;">
                </a>
            </div>
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="col-form-label ">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label ">{{ __('Password') }}</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row m-t-20">
                        <div class=" col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end wrapper-page -->
@endsection

@section('script')
<script>
function updateTimer() {
    var now = new Date();
    var h = String(now.getHours()).padStart(2, '0');
    var m = String(now.getMinutes()).padStart(2, '0');
    var s = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('login-timer').textContent = h + ':' + m + ':' + s;
}
setInterval(updateTimer, 1000);
updateTimer();

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
