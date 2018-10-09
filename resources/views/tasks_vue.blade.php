@extends('layouts.app')

@section('content')
    <tasks :tasks="{{ $tasks }}"></tasks>
@endsection