<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
    <header>
        <div class="nav-container container">
            <div class="nav-search-container">
                <a class="logo" href="/">ReadAndWArite</a>
                <form action="/product/search" class="search-bar-container">
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
    <div class="container login-container">
        <div class="form-container"> 
            <div class="form-title-container">
                <div class="form-title">Login</div>
            </div>
            <form class="login-form">
                
                <div class="login-form-section">
                    <div class="left">Email address</div>
                    <input type="email" class="form-control right" >
                </div>
                <div class="login-form-section">
                    <div class="left">Password</div>
                    <input type="password" class="form-control right">
                </div>
                <div class="login-form-section">
                    <div class="left"></div>
                    <div class="right">
                        <input type="checkbox" class="cb-input">
                        <div class="cb-label">Remember Me</div>
                    </div>
                </div>
                <div class="login-form-section">
                    <div class="left"></div>
                    <div class="right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>