@extends('layouts.app')
@section('content')
@include('groups.form', [
    'action' => route('groups.store'),
    'method' => 'post',
    'value' => old('name')
    ])
@endsection
