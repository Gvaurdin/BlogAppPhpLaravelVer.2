<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //$posts = DB::table("posts")->get();
        $posts = Post::query()->paginate(5);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)//string $id)
    {
//        $post = DB::table("posts")->find($id);
//        if (!$post)
//        {
//            abort(404);
//        }
        //$post =Post::query()->where('id', $id)->first();
        //$post = Post::query()->findOrFail($id);
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
