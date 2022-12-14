@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6">
            @can('create', \App\Models\Subject::class)
            <a href="{{ route('subjects.create') }}" class="link-dark">
                <h6>Новый предмет</h6></a>
            @endcan
        </div>
        <div class="col-6">
            <form action="{{ route('subjects.index') }}" method="get">
                <div class="row">
                    <div class="col-6">
                        <input class="form-control" name="name"
                               id="name" placeholder="Введите название предмета">
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
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td><a href="{{ route('groups.show',$subject->id) }}">{{ $subject->name }}</a></td>
                <td><div class="row">
                        @can('update', $subject)
                        <div class="col"><a href="{{ route('subjects.edit',$subject->id) }}" class="btn btn-primary">Изменить</a></div>
                        @endcan
                        @can('delete', $subject)
                        <div class="col"><form action="{{ route('subjects.destroy',$subject->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form></div>
                            @endcan
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        {{ $subjects->withQueryString()->links() }}
    </div>
    @endsection




















