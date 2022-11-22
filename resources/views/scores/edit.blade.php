@extends('layouts.app')
@section('content')
    @include('scores.form', [
        'action' => route('users.subjects.update',[$user, $subject]),
        'method' => 'put'
        ])
@endsection
