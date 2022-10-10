@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST">

            @csrf
            @method('PUT')

            <h1 class="mb-4">Edit post</h1>

            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" required id="title" name="title" max="255" value="{{old('title', $post->title)}}">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group mb-3">
                <label for="content">Content</label>
                <textarea class="form-control  @error('content') is-invalid @enderror" required id="content" name="content">{{old('content', $post->content)}}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>

              <button type="submit" class="mt-3 btn btn-primary">Update</button>

        </form>

    </div>

@endsection
