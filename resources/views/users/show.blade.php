@extends('layouts.app')
@section('content')
    <h5>ФИО: {{ $user->fio }}</h5><br>
    <h5>Дата рождения: {{ date("d.m.Y", strtotime($user->birth_date)) }}</h5>
@endsection
