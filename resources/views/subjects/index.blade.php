@extends('layouts.app')
@section('content')
    <a href="{{ route('subjects.create') }}" class="link-dark">
        <h6>Новый предмет</h6></a>
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
                        <div class="col"><a href="{{ route('subjects.edit',$subject->id) }}" class="btn btn-primary">Изменить</a></div>
                        <div class="col"><form action="{{ route('subjects.destroy',$subject->id) }}" method="post">
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
        {{ $subjects->links() }}
    </div>
    @endsection



















