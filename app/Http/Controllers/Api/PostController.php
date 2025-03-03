<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {

        return PostResource::collection(Post::all());

//              $response = [
//                   'success' => true,
//                   'message' => 'List all posts',
//                   'data' => $posts,
//               ];
//
//               return response()->json($response, 200);


    }

    public function show($id) {
        $post = Post::findOrFail($id);

        return (new PostResource($post))->additional([
            'success' => true,
            'message' => 'Posts retrieved successfully'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $post = Post::create($request->only(['title', 'text','user_id']));

        return (new PostResource($post))->additional([
            'success' => true,
            'message' => 'Post created successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ],400);
        }

        $post->update($request->only(['title', 'text', 'user_id']));

        return (new PostResource($post))->additional([
            'success' => true,
            'message' => 'Post updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFind($id);
        $post->delete();
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ],200);
    }
}
