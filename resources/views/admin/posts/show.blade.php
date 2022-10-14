@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{$post->title}}</h1>

        @if ($post->cover)
            <img src="{{asset('storage/' . $post->cover)}}" class="img-fluid"/>
        @else
            <img src="{{asset('img/no_cover.jpg')}}" class="img-fluid"/>
        @endif

        <h4>
            <span class="fw-bold">Slug:</span>
            {{$post->slug}}
        </h4>

        <div>
            <span class="fw-bold">Content:</span>
            {{$post->content}}
        </div>

        <div>
            <span class="fw-bold">Category:</span>
            {{$post->category?$post->category->name:'-'}}
        </div>

        <div>
            <span class="fw-bold">Tags:</span>
            @foreach ($post->tags as $tag)
                {{$tag->name}};
            @endforeach
        </div>


        <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-5">Back</a>

    </div>

@endsection

