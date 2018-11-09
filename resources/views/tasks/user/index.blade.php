@extends('layouts.app')

@section('content')
    <tasques :tasks="{{ $tasks}}"></tasques>
@endsection
