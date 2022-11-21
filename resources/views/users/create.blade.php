@extends('layouts.app')
@section('content')
    @include('users.form', [
        'action' => route('groups.users.store', $group),
        'method' => 'post'
        ])
@endsection
