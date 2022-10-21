@extends('layouts.app')

@section('content')

    <div class="container">


        <div class="mb-4 d-flex justify-content-end">
            <a class="btn btn-primary" href="{{route('admin.posts.create')}}">+ Add New Post</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cover Thumb</th>
                  <th scope="col">Title</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Category</th>
                  <th scope="col">Tags</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>

                        <th scope="row">
                            @if ($post->cover)
                                <img src="{{asset('storage/' . $post->cover)}}" class="img-thumbnail" style="width:75px;"/>
                            @else
                                <img src="{{asset('img/no_cover.jpg')}}" class="img-thumbnail" style="width:75px;"/>
                            @endif
                        </th>

                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{($post->category)?$post->category->name:'-'}}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                {{$tag->name}};
                            @endforeach
                        </td>
                        <td class="d-flex">

                            @if ($post->deleted_at)
                                <a href="{{route('admin.posts.restore', ['post' => $post->id])}}" class="btn btn-success me-2 ">Restore</a>

                                <form method="POST" action="{{route('admin.posts.forceDelete', ['post' => $post->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2 ">Destroy</button>
                                </form>

                            @else
                                <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary me-2 ">Show</a>
                                <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-warning me-2 ">Edit</a>
                                <form method="POST" action="{{route('admin.posts.destroy', ['post' => $post->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2 ">Delete</button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>


    </div>

@endsection

