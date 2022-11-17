@extends('layouts.app')
@section('content')
    <a href="{{route('subjects.create')}}" class="link-dark">
        <h6>Новый предмет</h6></a>
    <div class="row">
        @foreach($subjects as $subject)
            <div class="card mb-2 shadow-sm ">
                <div class="card-body p-1">
                    <div class="row">
                    <div class="col-8"><a href="{{route('subjects.show',$subject->id)}}">{{$subject->name}}</a></div>
                        <div class="col-2"><a href="{{route('subjects.edit',$subject->id)}}" class="btn btn-primary">Изменить</a></div>
                        <div class="col-2"><form action="{{route('subjects.destroy',$subject->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{$subjects->links()}}
    </div>
@endsection
