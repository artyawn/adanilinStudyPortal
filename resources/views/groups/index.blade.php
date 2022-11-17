@extends('layouts.app')
@section('content')
    <a href="{{route('groups.create')}}" class="link-dark">
        <h6>Новая группа</h6></a>
    @foreach($groups as $group)
        <div class="card mb-2 shadow-sm ">
            <div class="card-body p-1">
                <div class="row">
                    <div class="col-8"><a href="{{route('groups.show',$group->id)}}">{{$group->name}}</a></div>
                    <div class="col-2"><a href="{{route('groups.edit',$group->id)}}" class="btn btn-primary">Изменить</a></div>
                    <div class="col-2"><form action="{{route('groups.destroy',$group->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form></div>
                </div>
            </div>
        </div>
            @endforeach
    <div class="row">
        {{$groups->links()}}
    </div>
@endsection
