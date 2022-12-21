@extends('layouts.app')
@inject('avatar', 'App\Services\FileService')
@section('content')
    <div class="row">
    <div class="col-6">
        <div class="col-lg-6">
          <img src="{{ $avatar->showAvatar($user) }}" class=rounded-circle alt="avatar">
        </div><br>
    <h5>ФИО: {{ $user->fio }}</h5><br>
    <h5>Дата рождения: {{ $user->birth_date }}</h5>
    <h5>Группа: {{ $user->group->name }}</h5>
    <h5>Адрес: {{ $user->full_address }}</h5>
    <h5>Email: {{ $user->email }}</h5>
    <h5>Роль: {{ $user->role }}</h5>
    </div>
    <div class="col-6">
        @can('edit-score', $user)
        <a href="{{ route('users.subjects.create', $user) }}" class="link-dark">
            <h6>Новая оценка</h6></a>
        @endcan
        <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">Предмет</th>
            <th scope="col">Оценка</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->pivot->score }}</td>
                <td>
                    @can('edit-score', $user)
                    <div class="row">
                        <div class="col"><a href="{{ route('users.subjects.edit', [$user, $subject]) }}" class="btn btn-primary">Изменить</a></div>
                        <div class="col"><form action="{{ route('users.subjects.destroy', [$user, $subject]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form></div>
                    </div>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
