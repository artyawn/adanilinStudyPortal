@extends('layouts.app')
@section('content')
    <a href="{{ route('users.create') }}" class="link-dark">
        <h6>Добавить студента</h6></a>
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Имя</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->fio }}</a></td>
                <td><div class="row">
                        <div class="col"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Изменить</a></div>
                        <div class="col"><form action="{{ route('users.destroy', $user->id) }}" method="post">
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
        {{ $users->links() }}
    </div>
@endsection
