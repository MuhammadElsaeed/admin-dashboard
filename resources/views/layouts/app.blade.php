<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            @include('partials.header')
            <main class="py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}" defer></script>
        <script src="{{ asset('js/responsive.bootstrap4.min.js') }}" defer></script>
        <script src="{{ asset('js/main.js') }}" defer></script>

    </body>
</html>
