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
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>

                        <td class="d-flex">
                            <a href="{{route('admin.categories.show', ['category' => $category->id])}}" class="btn btn-primary me-2 ">Show</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>

@endsection

