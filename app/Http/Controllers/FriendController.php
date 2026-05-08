<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index() {
        $userId = Auth::id();
        
        $friendships = Friend::where(function($query) use ($userId) {
            $query->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')->get();

        $friends = $friendships->map(function($friendship) use ($userId) {
            $friendId = $friendship->user_id === $userId ? $friendship->friend_id : $friendship->user_id;
            $user = User::find($friendId);
            $user->friendship_id = $friendship->id;
            return $user;
        });

        $pendingRequests = Friend::with('user')->where('friend_id', $userId)->where('status', 'pending')->get();
        
        $usersAndPosts = []; // Placeholder for layout
        return view('friends', compact('friends', 'pendingRequests', 'usersAndPosts'));
    }

    public function store(Request $request) {
        $request->validate(['unique_code' => 'required|exists:users,unique_code']);
        
        $friend = User::where('unique_code', $request->unique_code)->firstOrFail();

        if ($friend->id === Auth::id()) {
            return back()->withErrors(['unique_code' => 'You cannot add yourself!']);
        }
        
        // Prevent duplicate requests
        $exists = Friend::where(function($query) use ($friend) {
            $query->where('user_id', Auth::id())->where('friend_id', $friend->id);
        })->orWhere(function($query) use ($friend) {
            $query->where('user_id', $friend->id)->where('friend_id', Auth::id());
        })->exists();

        if (!$exists) {
            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $friend->id,
                'status' => 'pending'
            ]);
        }
        return back()->with('success', 'Friend request sent!');
    }

    public function update(Request $request, $id) {
        $friend = Friend::where('id', $id)->where('friend_id', Auth::id())->firstOrFail();
        $friend->update(['status' => 'accepted']);
        return back()->with('success', 'Friend request accepted!');
    }

    public function destroy($id) {
        $friend = Friend::where('id', $id)->where(function($q) {
            $q->where('user_id', Auth::id())->orWhere('friend_id', Auth::id());
        })->firstOrFail();
        $friend->delete();
        return back()->with('success', 'Friend removed.');
    }
}
