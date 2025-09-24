@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Tasks</h2>
    <a href="{{ route('task.create') }}" class="btn btn-primary mb-3">Assign Task</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Assignee</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->assignee->name ?? 'N/A' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->due_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
