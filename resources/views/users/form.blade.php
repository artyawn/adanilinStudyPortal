<div class="row">
    <div class="col-lg-6">
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            @method($method)
            <input type="text" class="form-control" name="fio"
                   id="fio" placeholder="Введите ФИО" value="{{ old('fio', $user->fio ?? null) }}">
            <br>
            @error('fio')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="date" class="form-control" name="birth_date"
                   id="birth_date" placeholder="Введите дату рождения" value="{{ old('birth_date', $user->birth_date ?? null) }}">
            <br>
            @error('birth_date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="string" class="form-control" name="address[city]"
                   id="city" placeholder="Введите название города" value="{{ old('address.city', $user->address['city'] ?? null) }}">
            <br>
            @error('address.city')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="string" class="form-control" name="address[street]"
                   id="street" placeholder="Введите улицу проживания" value="{{ old('address.street', $user->address['street'] ?? null) }}">
            <br>
            @error('address.street')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="int" class="form-control" name="address[home]"
                   id="home" placeholder="Введите номер дома" value="{{ old('address.home', $user->address['home'] ?? null) }}">
            <br>
            @error('address.home')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <x-group-select :user="isset($user) ? $user : null" id="group_id" class="block mt-1 w-full" type="text" name="group_id" :value="old('group_id')" required ></x-group-select>
            <br>
            @error('group_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <x-role-select :user="isset($user) ? $user : null" id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required ></x-role-select>
            <br>
            @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="email"
                   id="email" placeholder="Введите email" value="{{ old('email', $user->email ?? null) }}">
            <br>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="file" class="form-control" name="avatar" id="avatar">
            <br>
            @error('avatar')
            <div class="alert alert-danger"> {{ $message }}</div>
            @enderror
            @if(!isset($user))
            <input type="text" class="form-control" name="password"
                   id="password" placeholder="Введите пароль">
            <br>
            @endif
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
        </form>
    </div>
</div>
