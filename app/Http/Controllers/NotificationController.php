<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $userId = Auth::id();

        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        $usersAndPosts = [];
        return view('notification', compact('notifications', 'usersAndPosts'));
    }

    public function update($id) {
        $notification = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notification->update(['is_read' => true]);
        return back();
    }
}
