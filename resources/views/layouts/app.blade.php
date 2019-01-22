<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2680C2"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] { display: none }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        <snackbar></snackbar>
        <navigation v-model="drawer"></navigation>
        <v-navigation-drawer
                v-model="drawerRight"
                fixed
                right
                clipped
                app
        >
            <v-card>
                <v-card-title class="primary white--text"><h4>Perfil</h4></v-card-title>
                <v-layout row wrap>
                    <v-flex xs12>
                        <ul>
                            <li>Nom : {{ Auth::user()->name }}</li>
                            <li>Email : {{ Auth::user()->email }}</li>
                            <li>Admin : {{ Auth::user()->admin }}</li>
                            <li>Roles : {{ implode(',',Auth::user()->map()['roles']) }}</li>
                            <li>Permissions : {{ implode(', ',Auth::user()->map()['permissions']) }}</li>
                        </ul>
                    </v-flex>
                </v-layout>
            </v-card>
            <v-card>
                <v-card-title class="primary white--text"><h4>Opcions administrador</h4></v-card-title>

                <v-layout row wrap>
                    @impersonating
                    <v-flex xs12>
                        <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">
                            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}" alt="avatar">
                        </v-avatar>
                    </v-flex>
                    @endImpersonating
                    <v-flex xs12>
                        @canImpersonate
                        <impersonate label="Entrar com..." url="/api/v1/regular_users"></impersonate>
                        @endCanImpersonate
                        @impersonating
                        {{ Auth::user()->impersonatedBy()->name }} està suplantant {{ Auth::user()->name }}
                        <a href="impersonate/leave">Abandonar la suplantació</a>
                        @endImpersonating
                    </v-flex>
                </v-layout>
            </v-card>
        </v-navigation-drawer>
        <v-toolbar
                color="primary"
                dark
                app
                clipped-left
                clipped-right
                fixed>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            <v-spacer></v-spacer>

            <span v-role="'SuperAdmin'"><git-info></git-info></span>

            <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">
                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
            </v-avatar>
            <v-form action="logout" method="POST">
                @csrf
                <v-btn color="primary" type="submit">Logout</v-btn>
            </v-form>
        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2017</span>
        </v-footer>
    </v-app>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
