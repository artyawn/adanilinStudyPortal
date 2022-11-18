@extends('layouts.app')
@section('content')
@include('subjects.form', [
    'action' => route('subjects.update', $subject),
    'method' => 'put',
    'value' => $subject->name
    ])
@endsection
