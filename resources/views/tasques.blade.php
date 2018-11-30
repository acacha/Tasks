@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <tasques :tasks="{{ $tasks }}" :users="{{ $users }}" uri="{{ $uri }}"></tasques>
                {{--@if (Auth::user()->can('tasks.manage'))--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/tasks"></tasques> // TOTES LES TASQUES--}}
                {{--@else--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/user/tasks"></tasques>--}}
                {{--@endif--}}

                {{--@can('tasks.manage')--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/tasks"></tasques> // TOTES LES TASQUES--}}
                {{--@else--}}
                {{--<tasques :tasks="{{ $tasks }}" :uri="/api/v1/user/tasks"></tasques>--}}
                {{--@endif--}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
