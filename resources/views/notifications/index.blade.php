@extends('layouts.app')

@section('content')
    <notifications
            :notifications="{{ $notifications }}"
            :user-notifications="{{ $userNotifications }}"
            :users="{{ $users }}"
    ></notifications>
@endsection
