@extends('layouts.app')

@php
$channel = 'App.Log.Module.' . studly_case($module->name);
$title = 'Registre de canvis mòdul: ' . $module->name;
$returnUrl = '/' . $module->name;
$refreshUrl = '/api/v1/changelog/module/' . $module->name;
@endphp

@section('content')
    <changelog refresh-url="{{ $refreshUrl }}" return-url="{{ $returnUrl }}" title="{{ $title }}" channel="{{ $channel }}"  :logs="{{ $logs }}" :users="{{ $users }}"></changelog>
@endsection
