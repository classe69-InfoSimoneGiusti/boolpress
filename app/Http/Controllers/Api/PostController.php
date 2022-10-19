<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        //Eager Loading Multiple Relationships
        //$posts = Post::with(['category', 'tags'])->get();

        $posts = Post::with(['category', 'tags'])->paginate(2);

        $posts->each(function($post) {
            if ($post->cover) {
                $post->cover = asset('storage/' . $post->cover);
            } else {
                $post->cover = asset('img/no_cover.jpg');
            }
        });

        /*foreach ($posts as $post) {
            if ($post->cover) {
                $post->cover = asset('storage/' . $post->cover);
            } else {
                $post->cover = asset('img/no_cover.jpg');
            }
        }*/

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->firstOrFail();

        if ($post->cover) {
            $post->cover = asset('storage/' . $post->cover);
        } else {
            $post->cover = asset('img/no_cover.jpg');
        }

        return response()->json([
            'success' => true,
            'result' => $post
        ]);

    }


    public function random() {

        $post = Post::inRandomOrder()->firstOrFail();

        return response()->json([
            'success' => true,
            'result' => $post
        ]);

    }


}
