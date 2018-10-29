@extends('layouts.login')

@section('title')
    Login a l'aplicació de Tasks
@endsection
@section('content')
    <v-content>
        @if ($errors->any())
            <v-alert
                    :value="true"
                    type="error"
            >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </v-alert>
        @endif
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-form action="/login" method="POST">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                @csrf
                                <v-text-field prepend-icon="person" name="email" label="Login" type="text" value="{{ old('email') }}"></v-text-field>
                                <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" type="submit">Login</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection
