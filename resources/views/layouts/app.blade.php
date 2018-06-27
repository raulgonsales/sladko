<html>
<head>
    @include('includes.head')
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark flex-row">
    <a class="navbar-brand mr-auto" href="/">
        Sladko Brno
    </a>
    <ul class="navbar-nav flex-row mr-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-3 mr-lg-0"
               id="navbarDropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                <i class="fa fa-user"></i>
                <span class="caret">User</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="">My profile</a>
                <a class="dropdown-item" href="">Logout</a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler ml-lg-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
    @include('includes.header')

    @yield('content')

    @include('includes.footer')
</body>
</html>