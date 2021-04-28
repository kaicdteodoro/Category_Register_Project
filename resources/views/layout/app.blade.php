<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        table{
            margin-bottom: 20px;
        }
        body{
            padding: 20px;
        }

        .navbar{
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    @component('layout.components.nav-bar')
    @endcomponent
    <main role="main">
        @hasSection('body')
            @yield('body')
        @endif
    </main>
</div>
<script src="{{asset('js/app.js')}}"></script>
@hasSection('javascript')
    @yield('javascript')
@endif
</body>
</html>
