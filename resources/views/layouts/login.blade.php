<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2680C2"/>
    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] { display: none }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        @yield('content')
    </v-app>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
