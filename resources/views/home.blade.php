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
        <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div> <a href="/login">login</a> </div>
            <div> <a href="/register">register</a> </div>
            <div class="content">
                <div class="title m-b-md">
                    ReadandWArite
                </div>
            </div>
        </div>
    </body>
</html>
