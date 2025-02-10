<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        $posts = DB::table('posts')
            ->join('categories_posts','posts.id','=','categories_posts.post_id')
            ->where('categories_posts.category_id',$id)
            ->select('posts.*')
            ->get();
        return view('categories.show', [
            'id' => $id,
            'category' => $category,
            'posts' => $posts
            ]);
    }
}
