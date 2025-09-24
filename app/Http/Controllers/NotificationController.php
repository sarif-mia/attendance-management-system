<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Notification;
use Auth;
class NotificationController extends Controller {
    public function index() {
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();
        return view('admin.notifications', compact('notifications'));
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        Notification::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
        return back()->with('success', 'Notification sent!');
    }
    public function markRead($id) {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();
        return back();
    }
}
