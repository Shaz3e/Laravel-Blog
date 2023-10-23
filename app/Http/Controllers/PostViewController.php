<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostViewController extends Controller
{
    public function list()
    {
        $posts = Post::where('post_status_id', 2)->orderBy('created_at', 'desc')->paginate(10);

        return view('posts', compact('posts'));
    }

    public function post($id, $slug)
    {
        $post = Post::where('id', $id)
                    ->where('slug', $slug)
                    ->firstOrFail(); // Use firstOrFail to automatically handle 404 if no record is found
    
        return view('single', compact('post'));
    }
}
