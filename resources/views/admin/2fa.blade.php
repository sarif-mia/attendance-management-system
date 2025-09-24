@extends('layouts.master')

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Two-Factor Authentication</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Security Settings</li>
     </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="header-title mb-4">Enable Two-Factor Authentication</h4>
        <p>For enhanced security, enable two-factor authentication (2FA) for your admin account.</p>
        <form method="POST" action="#">
            @csrf
            <button type="submit" class="btn btn-primary">Enable 2FA</button>
        </form>
        <hr>
        <p>After enabling, you will be prompted for a verification code on each login.</p>
    </div>
</div>
@endsection
