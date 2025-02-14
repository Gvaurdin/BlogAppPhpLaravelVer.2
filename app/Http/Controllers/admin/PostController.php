<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => DB::table('posts')->get()
        ]);
    }
    public function create()
    {
        $users = User::all();

        return view('admin.posts.create',[
            'users' => $users
        ]);
    }

    public function edit(Post $post)
    {
        //$post = DB::table('posts')->where('id', $id)->first();

        $users = User::all();
        return view('admin.posts.edit', [
            'users' => $users,
            'post' => $post
        ]);
    }

    public function delete(Post $post)
    {
        return view('admin.posts.delete', ['post' => $post]);
    }

    public function store(UpdatePostRequest $request)
    {
        //если запрос post на создание
        if($request->isMethod('post'))
        {
            //валидация
            $validatedData = $request->validated();
//            DB::table('posts')->insert([
//                'title' => $request->input('title'),
//                'text' => $request->input('text'),
//                'user_id' => Auth::id(),
//            ]);
//            $id = DB::getPdo()->lastInsertId();

            try {
                $imagePath = null;
                if($request->hasFile('image'))
                {
                    $imagePath = $request->file('image')->store('posts','public');
                }
                $validatedData['image'] = $imagePath;
                $post = Post::create($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.posts.create')->with('error', 'Ошибка добавления поста '
                    . $e->getMessage());
            }

            return redirect()->route('admin.posts.index', $post->id)->with('success','Пост успешно добавлен');
        }

        //если запрос put на редактирование
        if($request->isMethod('put'))
        {
            // Валидация данных
            $validatedData = $request->validated();

            //обновляем пост по id
//            DB::table('posts')
//                ->where('id',$request->id)
//                ->update($request->only('title','text'));

            try {
                $post = Post::query()->find($request->id);
                $post->update($validatedData);
            }catch (\Exception $e){
                return redirect()->route('admin.posts.edit')->with('error', 'Ошибка обновления поста '
                    . $e->getMessage());
            }
            return redirect()->route('admin.posts.index',$post->id)->with('success','Пост успешно обновлен');
        }
    }

    public  function deletePost(Request $request)
    {
        try {
            $post = Post::query()->find($request->id);
            $post->delete();
        }catch (\Exception $e){
            return redirect()->route('admin.posts.index')->with('error', 'Ошибка удаления поста '
                . $e->getMessage());
        }
        return redirect()->route('admin.posts.index',$post->id)->with('success','Пост успешно удален');
    }
}
