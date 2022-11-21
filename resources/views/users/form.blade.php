<div class="row">
    <div class="col-lg-6">
        <form action="{{ $action }}" method="post">
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
            <select class="form-select" name="group_id" >
                @foreach($groups as $group)
            <option @if (isset($user) && $group->id == $user->group->id)
                    selected
                    @endif value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            <br>
            @error('group_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
        </form>
    </div>
</div>
