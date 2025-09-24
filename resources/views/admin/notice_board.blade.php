@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Digital Notice Board</h2>
    @foreach($notices as $notice)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $notice->title }}</h4>
                <p>{{ $notice->body }}</p>
                <small>Posted by {{ $notice->user->name }} on {{ $notice->created_at->format('d M Y, h:i A') }}</small>
            </div>
        </div>
    @endforeach
    <a href="{{ route('notice.create') }}" class="btn btn-primary">Create Notice</a>
</div>
@endsection
