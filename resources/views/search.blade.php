<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- styles -->
    <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <div class="nav-container container">
            <div class="nav-search-container">
                <a class="logo" href="/">ReadAndWArite</a>
                <form action="/search" class="search-bar-container">
                    <input type="text" class="search-bar" name="query" placeholder="search for stationary" value={{ Request::get('query') }}>
                    <button class="btn-primary">Search</button>
                </form>
            </div>
            <div class="nav-right">
                <a class="login-btn" href="/login">login</a>
                <a class="register-btn" href="/register">register</a>
            </div>
        </div>
    </header>
    <div class="container search-container">
        @if ($data->count())
        <div class="result-wrap-container">
            @foreach ($data as $eachData)
                <div class="image-card">
                    <img src={{ asset('images/' . $eachData->image) }} alt={{ $eachData->name }}>
                    <div class="detail-container">
                        <div class="name">{{ $eachData->name }}</div>
                        <div class="desc">{{ $eachData->description }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $data->appends($_GET)->links() }}
        @else
            <div>ga ad</div>
        @endif
    </div>
</body>

</html>
