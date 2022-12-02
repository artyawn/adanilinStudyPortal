@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <tr>
        <th scope="col">Студент\Предмет</th>
            @foreach($subjects as $subject)
            <th scope="col">{{ $subject->name }}</th>
            @endforeach
        </tr>
        <tr>
            <th scope="row">Ср. оценка</th>
            @foreach($average as $avr)
                <td>{{ $avr }}</td>
            @endforeach
        </tr>
            @foreach($users as $user)
                <tr>
                    <th class={{ $user->color }} scope="row">{{ $user->fio }}</th>
                    @foreach($subjects as $subject)
               <td>{{ $user->subjects->firstWhere('id', $subject->id)->pivot->score ?? 0}}</td>
                    @endforeach
                </tr>
            @endforeach
    </table>
    <div class="row">
        {{ $users->links() }}
    </div>
    <div class="row">
    <div class="col-6">
    <h5>Отличники</h5><br>
        @foreach($best_users as $user)
        <h6>{{ $user->fio }}</h6>
        @endforeach
    </div>
    <div class="col-6">
    <h5>Хорошисты</h5><br>
        @foreach($good_users as $user)
            <h6>{{ $user->fio }}</h6>
        @endforeach
    </div>
    </div>
@endsection
