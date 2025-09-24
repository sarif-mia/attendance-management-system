<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Auth;
class TaskController extends Controller {
    public function index() {
        $tasks = Task::where('assigned_to', Auth::id())->orWhere('assigned_by', Auth::id())->latest()->get();
        return view('admin.tasks', compact('tasks'));
    }
    public function create() {
        return view('admin.create_task');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'required|date',
        ]);
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => Auth::id(),
            'due_date' => $request->due_date,
        ]);
        return redirect()->route('task.index')->with('success', 'Task assigned!');
    }
}
