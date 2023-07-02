<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@stack('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

    <style>
        body {
            background-color: rgba(0, 0, 0, .1);
        }

        .cardCustom {
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(25, 0, 255, .2);
            transition: .3s
        }

        .cardCustom:hover {
            box-shadow: 0 8px 30px 0 rgba(0, 0, 0, .2)
        }

        .cardContainer {
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(25, 0, 255, .2);
            transition: .3s
        }

        .rounded-custom {
            background-color: #8a2be2;
            border-radius: 100px !important
        }

        .rounded-custom:hover {
            background-color: #5d00ff
        }

        .programImg img {
            border: 1px solid;
            max-width: 100%
        }
        .ck-editor_editable_inline{
            min-height: 400px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/" type="etx">InfoBlogg</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li>
                        <a class="nav-link {{ Route::currentRouteName() === 'post.index' || Route::currentRouteName() === 'post.show' ? 'active' : '' }}" href="{{ route('post.index') }}">Blog</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-info" type="submit">Search</button>
                </form>
            </div>
            @guest
                <div class="my-3 text-center m-lg-0">
                    <button type="button" class="btn btn-info ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
                </div>
            @endguest
            @auth
                <ul class="navbar-nav ms-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('post.create') }}">Create a Post</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif

                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth

        </div>
    </nav>

    @if ($errors->any())
        <div class="container my-5">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>Error: </strong> {{ $error }} <br />
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container my-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="cardContainer container bg-white">
        <div class="my-5">
            @yield('content')
        </div>
    </div>


    {{-- Login Modal --}}
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModelTitle">Login Here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email-id</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your mail id" required="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Signup Modal --}}
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModelTitle">SignUp Here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('signup') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required="">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">G-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" required="">
                        </div>
                        <div class="mb-3">
                            <label for="pass1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass1" name="password" placeholder="Choose your password" required="">
                        </div>
                        <div class="mb-3">
                            <label for="pass2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="pass2" name="password_confirmation" placeholder="Enter your password again" required="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        .ck-editor_editable_inline{
            min-height: 400px;
        }
    </script>
</body>

</html>
