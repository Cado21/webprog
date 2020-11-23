@extends('layouts.app')
@section('content')
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css" >
<div class="container">
    <div class="container content-wrapper">
        <form class="search-form" action="/product/search" method="GET">
            <div class="title">ReadAndWArite</div>
            <input type="text" class="search-bar" name="query" placeholder="search for stationary" >
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="image-container">
            @foreach ($data as $type)
                <a href={{'/product/search?type=' . $type->name }}><img src={{ asset('images/' . $type->image) }} alt={{$type->name}} width="300" height="300"/></a>
            @endforeach
        </div>
    </div>
</div>
@endsection
