<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>@yield('title')</title>
</head>
<body>
<header>
<div class="navbar">
    <div class="navbar__logo">PostHub</div>
    <nav class="navbar__nav">
        <ul class = "navbar__links">
            <li><a href="{{url("/")}}" class="navbar__link-item navbar__link-item--active"> Home </a></li>
            <li><a href="{{url("users")}}" class="navbar__link-item"> Users </a></li>  
        </ul>
    </nav>
</div>
</header>
    @yield('content')
</body>
</html>