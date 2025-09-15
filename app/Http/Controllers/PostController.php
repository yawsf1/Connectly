<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function home() {
        $usersAndPosts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.id as user_id',
                     'users.name', 
                     'posts.id as post_id', 
                     'posts.content', 
                     'posts.created_at', 
                     'users.avatar',
                     DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%y") as createdDate'), 
                     DB::raw('DATE_FORMAT(posts.created_at, "%H:%i") as createdTime'))                
            ->orderBy('posts.created_at', 'desc')
            ->get();
        
        return view('home', compact('usersAndPosts'));
    }

    public function makingPost(Request $request) {
        $inputs = $request->validate([
            'content' => 'required|min:2|max:5000',
        ]);

        $inputs['content'] = strip_tags($inputs['content']);
        $inputs['user_id'] = Auth::id();

        Post::create($inputs);

        return redirect()->route('home')->with('success', 'Post created!');
    }
}
