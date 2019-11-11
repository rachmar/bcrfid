<!DOCTYPE html>
<html>
<head>
    @include('partials._header')

    @yield('css')

</head>

<body style="background-color: #d2d6de;">

  <div id="app">

     @yield('content')

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>

  @yield('script')
  
</body>
</html>