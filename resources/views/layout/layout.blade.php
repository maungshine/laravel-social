<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="https://kit.fontawesome.com/26b6f2767d.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">Social</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      @guest
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                      </li>
                      @endguest
                      
                      @auth
                      
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('viewProfile', ['user' => Auth::user()]) }}">Profile</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('followingFeeds') }}">Following Feeds</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}">Create Post</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                      </li>
                      @endauth
                    </ul>
                    
                    <form class="d-flex" action="{{ route('searchPosts') }}" method="POST" role="search">
                      @csrf
                      <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </div>
              </nav>
        </header>
        <main>
            <div class="container">
                @yield('content')
               </div>
        </main>
       
    </body>
</html>
