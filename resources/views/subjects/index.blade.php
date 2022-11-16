@extends('layouts.app')
@section('content')
    <a href="{{route('subjects.create')}}" class="link-dark">
        <h6>Новый предмет</h6></a>
    <div class="row">
        @foreach($subjects as $subject)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <a href="{{route('subjects.show',$subject->id)}}"><h4>{{$subject->name}}</h4></a>
                    <a href="{{route('subjects.edit',$subject->id)}}">Изменить</a><br>
                    <form action="{{route('subjects.destroy',$subject->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{$subjects->links()}}
    </div>
@endsection
