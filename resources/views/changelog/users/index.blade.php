@extends('layouts.app')

@php
$channel = 'App.Log.User.' . studly_case($user->id);
$title = "Registre de canvis de l'usuari: " . $user->name;
$refreshUrl = '/api/v1/changelog/user/' . $user->id;
@endphp

@section('content')
    <changelog refresh-url="{{ $refreshUrl }}" title="{{ $title }}" channel="{{ $channel }}"  :logs="{{ $logs }}" :users="{{ $users }}"></changelog>
@endsection
