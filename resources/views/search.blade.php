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
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="row">
                <a class="logo" href="/">ReadAndWArite</a>
                <form action="/search">
                    <input type="text" class="search-bar" name="query" placeholder="search for stationary">
                    <input type="submit" value="Search" class="btn-primary">
                </form>
            </div>
            <div class="row">
                <a class="login-btn" href="/login">login</a>
                <a class="register-btn" href="/register">register</a>
            </div>
        </div>
    </header>
    @if ($data->count())
        <div>{{ json_encode($data) }} </div>
    @else
        <div>ga ad</div>
    @endif
</body>

</html>
