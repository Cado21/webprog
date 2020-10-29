<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- styles -->
        <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <header>
            <div class="nav-container">
                <a class="login-btn" href="/login">login</a>
                <a class="register-btn" href="/register">register</a>
            </div>
        </header>
        <div class="content-wrapper">
            <form class="search-form">
                <div class="title">ReadandWArite</div>
                <input type="text" id="search-bar" name="search-bar" placeholder="search for stationary">
                <button class="search-btn">search</button>
            </form>
            <div class="image-container">
                <img src="https://media.wired.com/photos/5be4cd03db23f3775e466767/125:94/w_2375,h_1786,c_limit/books-521812297.jpg" alt="testing" width="300" height="300">
                <img src="https://media.wired.com/photos/5be4cd03db23f3775e466767/125:94/w_2375,h_1786,c_limit/books-521812297.jpg" alt="testing" width="300" height="300">
                <img src="https://media.wired.com/photos/5be4cd03db23f3775e466767/125:94/w_2375,h_1786,c_limit/books-521812297.jpg" alt="testing" width="300" height="300">
                <img src="https://media.wired.com/photos/5be4cd03db23f3775e466767/125:94/w_2375,h_1786,c_limit/books-521812297.jpg" alt="testing" width="300" height="300">
            </div>
        </div>
    </body>
</html>
