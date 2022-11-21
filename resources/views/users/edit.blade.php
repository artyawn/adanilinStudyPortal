@extends('layouts.app')
@section('content')
    @include('users.form', [
        'action' => route('groups.users.update', [$group->id, $user->id]),
        'method' => 'put'
        ])
@endsection
