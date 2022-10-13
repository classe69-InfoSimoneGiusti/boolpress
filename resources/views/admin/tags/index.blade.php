@extends('layouts.app')

@section('content')

    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Slug</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{$tag->id}}</th>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->slug}}</td>

                        <td class="d-flex">
                            <a href="{{route('admin.tags.show', ['tag' => $tag->id])}}" class="btn btn-primary me-2 ">Show</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>

@endsection

