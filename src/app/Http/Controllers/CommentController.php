<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        request()->validate([
            'body' => ['required']
        ]);

        $post->comments()->create([
            'body' => $request->input('body'),
            'user_id' => $request->user()->id,
            // implicit post_id used
        ]);

        return back();
    }
}
