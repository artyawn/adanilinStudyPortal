@extends('layouts.app')
@section('content')
    <a href="{{ route('groups.create') }}" class="link-dark">
        <h6>Новая группа</h6></a>
    <table class="table table-borderless">
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
        {{ $groups->links() }}
    </div>
@endsection
