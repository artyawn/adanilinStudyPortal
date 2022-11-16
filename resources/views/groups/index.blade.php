@extends('layouts.app')
@section('content')
    <a href="{{route('groups.create')}}" class="link-dark">
        <h6>Новая группа</h6></a>
    <div class="row">
            @foreach($groups as $group)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <a href="{{route('groups.show',$group->id)}}"><h4>{{$group->name}}</h4></a>
                        <a href="{{route('groups.edit',$group->id)}}">Изменить</a><br>
                        <form action="{{route('groups.destroy',$group->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
    </div>
    <div class="row">
        {{$groups->links()}}
    </div>
@endsection
