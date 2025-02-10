<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index(Posts $posts)
    {
        //$posts = $posts->getPosts();
        $posts = DB::table("posts")->get();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(string $id)
    {
//        $post = $posts->getPost($slug);
//        if (!$post)
//        {
//            abort(404);
//        }

        $post = DB::table("posts")->find($id);
        if (!$post)
        {
            abort(404);
        }
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
