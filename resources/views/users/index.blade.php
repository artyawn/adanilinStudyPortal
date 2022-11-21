@extends('layouts.app')
@section('content')
    <a href="{{ route('groups.users.create', $group->id) }}" class="link-dark">
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
                <td><a href="{{ route('groups.users.show', [$group->id, $user->id]) }}">{{ $user->fio }}</a></td>
                <td><div class="row">
                        <div class="col"><a href="{{ route('groups.users.edit', [$group->id, $user->id] ) }}" class="btn btn-primary">Изменить</a></div>
                        <div class="col"><form action="{{ route('groups.users.destroy', [$group->id, $user->id]) }}" method="post">
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





















