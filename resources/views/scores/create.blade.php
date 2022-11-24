@extends('layouts.app')
@section('content')
    @include('scores.form', [
        'action' => route('users.subjects.store', $user),
        'method' => 'post'
        ])
@endsection
