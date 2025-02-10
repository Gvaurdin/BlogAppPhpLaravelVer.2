<?php

namespace App\Http\Controllers\admin;


use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        //валидация
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|min:5|max:255',
            'text' => 'required|min:5|max:255',
        ]);
        DB::table('posts')->insert($request->except('_token'));
        $id = DB::getPdo()->lastInsertId();

        return redirect()->route('posts.show',$id)->with('success','Пост успешно добавлен');
    }
    public function post()
    {
        return view('admin.posts', [
            'posts' => Posts::getPosts()
        ]);
    }

    public function categories()
    {
        return view('admin.categories');
    }

//    public function addPostForm()
//    {
//        return view('admin.addPost');
//    }
//
//    public function addPost(Request $request)
//    {
//        $request->validate([
//            'title' => 'required|string|max:255',
//            'text' => 'required|string'
//        ]);
//
//        Posts::addPost($request->title, $request->text);
//
//        return redirect()->route('admin.posts')->with('success', 'Пост успешно добавлен!');
//    }
}
