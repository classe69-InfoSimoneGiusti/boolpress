@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Benvenuto nell'area amministrativa {{Auth::user()->name}}</h1>
    </div>

@endsection
