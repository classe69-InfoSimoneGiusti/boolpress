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
        $posts = Post::with(['category', 'tags'])->get();

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }


    public function show($slug)
    {
        //$post = Post::where('slug', $slug)->first();
    }


}
