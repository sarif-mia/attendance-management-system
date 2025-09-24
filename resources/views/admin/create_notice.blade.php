@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Create Notice</h2>
    <form action="{{ route('notice.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="body" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Post Notice</button>
    </form>
</div>
@endsection
