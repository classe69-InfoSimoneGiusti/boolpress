@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{$post->title}}</h1>

        <h4>
            <span class="fw-bold">Slug:</span>
            {{$post->slug}}
        </h4>


        <div>
            <span class="fw-bold">Content:</span>
            {{$post->content}}
        </div>



        <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-5">Back</a>

    </div>

@endsection

