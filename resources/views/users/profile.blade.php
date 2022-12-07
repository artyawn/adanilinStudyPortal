@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-6">
            <h5>Изменение личных данных</h5><br>
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('patch')
                <input type="text" class="form-control" name="fio"
                       id="fio" placeholder="Введите ФИО" value="{{ Auth::user()->fio }}">
                <br>
                @error('fio')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="date" class="form-control" name="birth_date"
                       id="birth_date" placeholder="Введите дату рождения" value="{{ Auth::user()->birth_date ?? null }}">
                <br>
                @error('birth_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="string" class="form-control" name="address[city]"
                       id="city" placeholder="Введите название города" value="{{ Auth::user()->address['city'] ?? null }}">
                <br>
                @error('address.city')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="string" class="form-control" name="address[street]"
                       id="street" placeholder="Введите улицу проживания" value="{{ Auth::user()->address['street'] ?? null }}">
                <br>
                @error('address.street')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="int" class="form-control" name="address[home]"
                       id="home" placeholder="Введите номер дома" value="{{ Auth::user()->address['home'] ?? null }}">
                <br>
                @error('address.home')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <select class="form-select" name="group_id" >
                    @foreach($groups as $group)
                        <option selected value="{{ Auth::user()->group->id }}">{{ Auth::user()->group->name }}</option>
                    @endforeach
                </select>
                <br>
                @error('group_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="email" class="form-control" name="email"
                       id="email" placeholder="Введите email" value="{{ Auth::user()->email }}">
                <br>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
            </form>
        </div>
                <div class="col-6">
                <h5>Изменение пароля</h5><br>
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('put')
                        <input type="text" class="form-control" name="old_password"
                               id="old_password" placeholder="Введите старый пароль" value="{{ old('old_password') }}"><br>
                        @error('old_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="new_password"
                               id="new_password" placeholder="Введите новый пароль" value="{{ old('new_password') }}"><br>
                        @error('new_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="new_password_confirmation"
                               id="new_password_confirmation" placeholder="Подтвердите пароль"><br>
                <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
           </form>
        </div>
    </div>
@endsection
