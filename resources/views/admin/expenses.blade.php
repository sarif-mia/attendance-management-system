@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <h2>Expenses</h2>
    <a href="{{ route('expense.create') }}" class="btn btn-primary mb-3">Add Expense</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->title }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->status }}</td>
                <td>{{ $expense->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
