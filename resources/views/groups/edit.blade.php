@extends('layouts.app')
@section('content')
@include('groups.form', [
    'action' => route('groups.update', $group),
    'method' => 'put'
    ])
@endsection
