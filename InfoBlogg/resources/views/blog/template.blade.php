<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@stack('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-info" type="submit">Search</button>
                </form>
            </div>
            @guest
                <div class="my-3 text-center m-lg-0">
                    <button type="button" class="btn btn-info ms-3" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal"
                        data-bs-target="#signupModal">Signup</button>
                </div>
            @endguest
            @auth
                <ul class="navbar-nav ms-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="/logout.php?return=/" method="post">
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
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your mail id" required="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required="">
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
                            <input type="text" class="form-control" id="fname" name="fname"
                                placeholder="First Name" required="">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                placeholder="Last Name" required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">G-mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@gmail.com" required="">
                        </div>
                        <div class="mb-3">
                            <label for="pass1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass1" name="password"
                                placeholder="Choose your password" required="">
                        </div>
                        <div class="mb-3">
                            <label for="pass2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="pass2" name="password_confirmation"
                                placeholder="Enter your password again" required="">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-2 mb-8" style="background-image: url('Carousal-Item-1.png');height: 70vh">
        <center>
            <h1 class="mx-auto mt-5 mb-7 pt-5" style="width: 600px; color:#2b3035"><b>All about INFOBLOGG</b></style>
            </h1>
            <button type="submit" class="btn btn-info mt-5 mb-6">Go To Blog</button>
        </center>
    </div>
    <div class="container-fluid">
        <div class="row">
            @for ($i = 0; $i < 10; $i++)
                <div class="col-4">
                    <div class="card my-3 mx-2 pb-2 mb-8">
                        <div class="mt-2">
                            <img src="website development-min.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the
                                    card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>
