<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        } 
            return redirect('/');
    }

    public function actualUpdatePost (Post $post, Request $request) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/');
        }

        $registered = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $registered['title'] = strip_tags($registered['title']);
        $registered['body'] = strip_tags($registered['body']);

        $post->update($registered);
        return redirect('/');

    }
    public function showEditScreen(Post $post) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/');
        }

        return view('edit-post', ['post'=> $post]);
    }
    public function createPost(Request $request) {
        $registered = $request->validate([
            "title"=> 'required',
            'body'=> 'required'
        ]);

        $registered['title'] = strip_tags($registered['title']);
        $registered['body'] = strip_tags($registered['body']);
        $registered['user_id'] = auth()->id();
        Post::create($registered);
        return redirect('/');
    }
}
