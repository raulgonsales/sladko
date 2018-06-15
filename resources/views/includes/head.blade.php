<title>App Name - @yield('title')</title>
<script src="{{ asset('js/app.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
@yield('pagestyle')
<script src="{{ asset('js/ajax.js') }}"></script>

@yield('pagescript')