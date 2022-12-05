@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6">
    <a href="{{ route('groups.create') }}" class="link-dark">
        <h6>Новая группа</h6></a>
        </div>
    <div class="col-6">
    <form action="{{ route('groups.index') }}" method="get">
        <div class="row">
        <div class="col-6">
        <input class="form-control" name="name"
               id="name" placeholder="Введите название группы">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-6">
            <button type="submit" class="btn btn-primary btn-sm">Поиск</button>
        </div>
        </div>
    </form>
    </div>
    </div>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Название</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
    @foreach($groups as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a></td>
            <td><div class="row">
                    <div class="col"><a href="{{ route('groups.edit', $group->id) }}" class="btn btn-primary">Изменить</a></div>
                    <div class="col"><form action="{{ route('groups.destroy', $group->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form></div>
                </div>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        {{ $groups->withQueryString()->links() }}
    </div>
@endsection
