<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- bootstrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- styles -->
        <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css" >

    </head>
    <body>
        <header>
            <div class="container nav-container">
                <a class="login-btn" href="/login">login</a>
                <a class="register-btn" href="/register">register</a>
            </div>
        </header>
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
    </body>
</html>
