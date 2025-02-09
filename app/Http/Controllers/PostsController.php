<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Routing\Controller;

class PostsController extends Controller
{
    public function index(Posts $posts)
    {

        return view('posts.index', [
            'posts' => $posts->getPosts()
        ]);
    }

    public function show(string $slug, Posts $posts)
    {
        $post = $posts->getPost($slug);
        if (!$post)
        {
            abort(404);
        }
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
