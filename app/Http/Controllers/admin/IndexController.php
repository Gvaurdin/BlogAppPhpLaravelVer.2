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

    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('admin.edit', ['post' => $post]);
    }

    public function delete($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('admin.delete', ['post' => $post]);
    }

    public function store(Request $request)
    {
        //если запрос post на создание
        if($request->isMethod('post'))
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

        //если запрос put на редактирование
        if($request->isMethod('put'))
        {
            // Валидация данных
            $validatedData = $request->validate([
                'title' => 'required|min:5|max:255',
                'text' => 'required|min:5|max:255',
            ]);

            //обновляем пост по id
            DB::table('posts')
                ->where('id',$request->id)
                ->update($request->only('title','text'));
            return redirect()->route('posts.show',$request->id)->with('success','Пост успешно обновлен');
        }
        //если запрос на удаление
        if($request->isMethod('delete'))
        {
            DB::table('posts')
                ->where('id',$request->id)
                ->delete();
            return redirect()->route('admin.posts')->with('success','Пост успешно удален');
        }
    }
    public function post()
    {
        return view('admin.posts', [
            'posts' => DB::table('posts')->get()
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
