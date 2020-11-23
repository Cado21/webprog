<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/login-register.css') }}" rel="stylesheet" type="text/css" >
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
                <div class="form-title">Register</div>
            </div>
            <form class="form" action="/register" method="POST">
                {{ csrf_field() }}
                @if ( $errors->first('error') )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="err-msg"> {{ $errors->first('error') }}  </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                @endif
                
                <div class="form-section">
                    <div class="left">Name</div>
                    <div class="right"> 
                        <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : ''}}" name="name" >
                        <div class="err-msg"> {{ $errors->first('name') }} </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="left">Email address</div>
                    <div class="right"> 
                        <input type="text" class="form-control {{ $errors->first('email') ? 'is-invalid' : ''}}" name="email">
                        <div class="err-msg"> {{$errors->first('email')}} </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="left">Password</div>
                    <div class="right"> 
                        <input type="password" class="form-control {{$errors->first('password') ? 'is-invalid' : ''}}" name="password">
                        <div class="err-msg"> {{$errors->first('password')}} </div>
                    </div>
                    
                </div>
                <div class="form-section">
                    <div class="left">Confirm Password</div>
                    <div class="right"> 
                        <input type="password" class="form-control {{$errors->first('confirm-password') ? 'is-invalid' : ''}}" name="confirm-password">
                        <div class="err-msg"> {{$errors->first('confirm-password')}} </div>
                    </div>
                </div>
                <div class="form-section">
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