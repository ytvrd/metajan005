<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/exa.css') }}">
    <!--<link rel="stylesheet" href="{{ asset('css/exa1.css') }}">-->
    <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/js/ex01.js') }}"></script>
    <script src="{{ asset('/js/ex02.js') }}"></script>
</head>
<body>
    <!--
    <h1>@yield('title')</h1>
    @section('menubar')
    <h2 class="menutitle">*メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1">
    -->
    <div class="content">
    @yield('content')
    </div>
    <div class="footer">
    @yield('footer')
    </div>
</body>
</html>