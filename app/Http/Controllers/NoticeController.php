<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\User;
use Auth;
class NoticeController extends Controller {
    public function index() {
        $notices = Notice::latest()->get();
        return view('admin.notice_board', compact('notices'));
    }
    public function create() {
        return view('admin.create_notice');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $notice = Notice::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        // Create notifications for all users
        $users = User::all();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'title' => $notice->title,
                'body' => $notice->body,
                'user_id' => $user->id,
                'is_read' => 0,
            ]);
        }

        return redirect()->route('notice.index')->with('success', 'Notice posted!');
    }
}
