@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <profile :user="{{ $user }}"></profile>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
