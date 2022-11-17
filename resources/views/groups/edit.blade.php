@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{route('groups.update',$group->id)}}" method="post">
                @method('put')
                @csrf
                <input type="text" class="form-control" name="name"
                       id="name" value="{{$group->name}}">
                <br>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
            </form>
        </div>
    </div>
@endsection
