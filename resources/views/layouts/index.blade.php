<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Blog') }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="http://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
    </head>


    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="/posts">Blog</a>
              </div>
              <ul class="nav navbar-nav">
                <li><a href="/posts">Home</a></li>
                <li><a href="/Myposts">My Posts</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <span class="glyphicon glyphicon-log-in"></span> Logout</a>
                  </form>
              </ul>
            </div>
          </nav>


        <div class="container">
            @yield('content')
        </div>
    </body>
    
</html>
