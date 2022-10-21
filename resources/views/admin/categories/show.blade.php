@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{$category->name}}</h1>

        <h4>
            <span class="fw-bold">Slug:</span>
            {{$category->slug}}
        </h4>

        @if (count($category->posts()->withTrashed()->get()))
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->posts()->withTrashed()->get() as $post)
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{route('admin.categories.index')}}" class="btn btn-primary mt-5">Back</a>

    </div>

@endsection

