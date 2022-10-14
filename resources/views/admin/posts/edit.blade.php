@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{route('admin.posts.deleteCover', ['post' => $post])}}" method="POST" id="deleteCoverForm" class="d-none">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETE IMAGE</button>
        </form>

        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <h1 class="mb-4">Edit post</h1>

            <div class="form-group mb-3">

                <p>Current image:</p>
                @if ($post->cover)
                    <img src="{{asset('storage/' . $post->cover)}}" class="img-fluid"/>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteCoverForm').submit();">Delete immagine</a>

                @else
                    <p>No loaded image!</p>
                @endif


                <label for="cover">Image cover</label>
                <input type="file" name="image" id="cover" class="form-control-file @error('image') is-invalid @enderror" />

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group mb-3">
                <label for="category_id">Category</label>

                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    <option {{(old('category_id')=="")?'selected':''}} value="">Nessuna categoria</option>
                    @foreach ($categories as $category)
                        <option {{(old('category_id', $post->category_id)==$category->id)?'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" max="255" value="{{old('title', $post->title)}}">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group mb-3">
                <label for="content">Content</label>
                <textarea class="form-control  @error('content') is-invalid @enderror" id="content" name="content">{{old('content', $post->content)}}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

            <h3>Tag:</h3>

            <div class="card p-3">
                @foreach ($tags as $tag)
                    <div class="form-group form-check">
                        @if ($errors->any())
                            <input {{(in_array($tag->id, old('tags', [])))?'checked':''}}
                                name="tags[]"
                                type="checkbox"
                                class="form-check-input"
                                id="tag_{{$tag->id}}"
                                value="{{$tag->id}}"
                            >
                        @else
                            <input {{($post->tags->contains($tag))?'checked':''}}
                                name="tags[]"
                                type="checkbox"
                                class="form-check-input"
                                id="tag_{{$tag->id}}"
                                value="{{$tag->id}}"
                            >
                        @endif
                        <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}} {{$tag->id}}</label>
                    </div>
                @endforeach

                @error('tags')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>

              <button type="submit" class="mt-3 btn btn-primary">Update</button>

        </form>

    </div>

@endsection
