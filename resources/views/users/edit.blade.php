@extends('layouts.app')
@section('content')
    @include('users.form', [
        'action' => route('users.update', $user),
        'method' => 'put'
        ])
@endsection
