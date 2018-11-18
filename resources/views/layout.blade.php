<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" typ="text/css">
    </head>

    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/members') }}">Home</a>
                <a href="{{ url('/members/create') }}">Create</a>
            </div>

            <div id="app">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</html>
