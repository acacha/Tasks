@extends('layouts.app')

@php
$channel = 'App.Log.Loggable.Incidents.' . $loggable->id;
$title = "Registre de canvis";
$refreshUrl = '/api/v1/changelog/loggable/' . $loggable->api_uri . '/' . $loggable->id;
@endphp

@section('content')
    <changelog refresh-url="{{ $refreshUrl }}" title="{{ $title }}" channel="{{ $channel }}"  :logs="{{ $logs }}" :users="{{ $users }}"></changelog>
@endsection
