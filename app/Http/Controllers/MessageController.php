<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index() {
        $userId = Auth::id();
        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'asc') // Changed to asc for chat bubble flow
            ->get();
            
        $friendships = \App\Models\Friend::where(function($query) use ($userId) {
            $query->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')->get();

        $friends = $friendships->map(function($friendship) use ($userId) {
            $friendId = $friendship->user_id === $userId ? $friendship->friend_id : $friendship->user_id;
            return User::find($friendId);
        });
            
        $usersAndPosts = []; // Placeholder for layout
        return view('messages', compact('messages', 'friends', 'usersAndPosts'));
    }

    public function store(Request $request) {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content
        ]);
        Notification::create([
            'user_id' => $request->receiver_id,
            'message' => Auth::user()->name . ' sent you a message.'
        ]);

        return back()->with('success', 'Message sent!');
    }
}
