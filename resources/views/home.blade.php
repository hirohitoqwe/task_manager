<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div>
        <div class="dropdown">
            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Lists
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Первая секция</a></li>
                <li><a class="dropdown-item" href="#">Первая секция</a></li>
                <li><a class="dropdown-item" href="#">Первая секция</a></li>
            </ul>
        </div>
    </div>

    <div>
        <div class="task">
            <ul class="list-group">
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" checked value="" aria-label="...">
                    First checkbox
                    <button style="position:absolute;left: 98%" type="button" class="btn-close" aria-label="Close"></button>
                </li>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    First checkbox
                    <button style="position:absolute;left: 98%" type="button" class="btn-close" aria-label="Close"></button>
                </li>

            </ul>
        </div>
    </div>

</div>
</body>
</html>
