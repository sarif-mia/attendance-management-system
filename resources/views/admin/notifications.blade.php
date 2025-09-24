@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Notifications</h2>
    @foreach($notifications as $notification)
        <div class="card mb-3 @if(!$notification->is_read) border-primary @endif">
            <div class="card-body">
                <h4>{{ $notification->title }}</h4>
                <p>{{ $notification->body }}</p>
                <small>{{ $notification->created_at->format('d M Y, h:i A') }}</small>
                @if(!$notification->is_read)
                    <form action="{{ route('notification.read', $notification->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Mark as Read</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
