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
use Illuminate\Support\Facades\Storage;

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

    public function store(UpdatePostRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }

            $validatedData = $request->validated();
            $validatedData['image'] = $imagePath;

            $post = Post::create($validatedData);

            return redirect()->route('admin.posts.index')->with('success', 'Пост успешно добавлен');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.create')->with('error', 'Ошибка добавления поста: ' . $e->getMessage());
        }
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $imagePath = $post->image;

            if ($request->hasFile('image')) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('image')->store('posts', 'public');
            }

            $validatedData = $request->validated();
            $validatedData['image'] = $imagePath;

            $post->update($validatedData);

            return redirect()->route('admin.posts.index')->with('success', 'Пост успешно обновлен');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.edit', $post->id)->with('error', 'Ошибка обновления поста: ' . $e->getMessage());
        }
    }

    public function delete(Post $post)
    {
        try {
            $post->delete();

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка удаления поста : ' .
                    $e->getMessage()
            ],500);
        }

        return response()->json([
            'success' => 'Пост успешно удален'
        ]);
    }
}
