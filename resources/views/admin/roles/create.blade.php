@extends('layouts.master')

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Add Role</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Create New Role</li>
     </ol>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="slug">Role Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>
</div>
@endsection
