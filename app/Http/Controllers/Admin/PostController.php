<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withTrashed()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:8000'
        ]);


        $data = $request->all();

        $img_path = Storage::put('cover', $data['image']);
        $data['cover'] = $img_path;

        $post = new Post();
        $slug = $this->calculateSlug($data['title']);
        $data['slug'] = $slug;
        $post->fill($data);
        $post->save();

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post creato con successo!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:8000'
        ]);




        $data = $request->all();

        if (array_key_exists('image', $data)) {

            if ($post->cover) {
                Storage::delete($post->cover);
            }

            $img_path = Storage::put('cover', $data['image']);
            $data['cover'] = $img_path;

        }

        if ($post->title !== $data['title']) {
            $data['slug'] = $this->calculateSlug($data['title']);
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post aggiornato con successo!');

    }


    protected function calculateSlug($title) {

        //inizio calcolo dello slug
        $slug = Str::slug($title, '-');

        $checkPost = Post::withTrashed()->where('slug', $slug)->first();

        $counter = 1;

        while($checkPost) {
            $slug = Str::slug($title . '-' . $counter, '-');
            $counter++;
            $checkPost = Post::withTrashed()->where('slug', $slug)->first();
        }
        //fine calcolo dello slug

        return $slug;

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) // equivale a $post = Post::findOrFail($id);
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Cancellazione avvenuta con successo!');
    }


    public function forceDelete($id) {

        $post = Post::withTrashed()->where('id', $id)->first();

        if ($post->cover) {
            Storage::delete($post->cover);
        }

        $post->tags()->sync([]);
        $post->forceDelete();

        return redirect()->route('admin.posts.index')->with('status', 'Eliminazione completa avvenuta con successo!');

    }

    public function deleteCover(Post $post) {

        if ($post->cover) {
            Storage::delete($post->cover);
        }

        $post->cover = null;
        $post->save();

        return redirect()->route('admin.posts.edit', [ 'post' => $post->id])->with('status', 'Immagine cancellata con successo');

    }


    public function restore ($id) {

        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->route('admin.posts.index')->with('status', 'Post ripristinato con successo');

    }



}
