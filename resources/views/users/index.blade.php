@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-6">
            @can('create', \App\Models\User::class)
    <a href="{{ route('users.create') }}" class="link-dark">
        <h6>Добавить студента</h6></a>
            @endcan
        </div>
        <div class="col-6">
        <form action="{{ route('users.index') }}" method="get">
        <div class="row">
            <div class="col-4">
            <input class="form-control" name="fio"
                   id="fio" placeholder="Введите ФИО">
                </div>
            @error('fio')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <div class="col-4">
            <input class="form-control" name="birth_date" type="date"
                   id="birth_date" placeholder="Введите дату рождения">
        </div>
            @error('birth_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-sm">Поиск</button>
        </div>
        </div>
        </form>
    </div>

    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Имя</th>
            <th scope="col">Роль</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->fio }}</a></td>
                <td>{{ $user->role }}</td>
                <td><div class="row">
                        @can('edit', $user)
                        <div class="col"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Изменить</a></div>
                        @endcan
                        @if(!$user->trashed())
                        @can('delete', $user)
                        <div class="col"><form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Удалить</button>
                            </form></div>
                            @endcan
                            @endif
                            @can('export', \App\Models\User::class)
                            <div class="col"><form action="{{ route('users.export', $user->id) }}" method="get">
                                    <button type="submit" class="btn btn-warning">PDF</button>
                                </form></div>
                                @endcan
                            @if($user->trashed())
                            @can('restore', $user)
                            <div class="col"><form action="{{ route('users.restore', $user->id) }}" method="get">
                                    <button type="submit" class="btn btn-success">Восстановить</button>
                                </form></div>
                            @endcan
                            @endif
                            @can('forceDelete', $user)
                            <div class="col"><form action="{{ route('users.force.delete', $user->id) }}" method="get">
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
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
