<html>
<head>
    @include('includes.head')
</head>
<body>
    <div class="container">
        @include('includes.header')
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>