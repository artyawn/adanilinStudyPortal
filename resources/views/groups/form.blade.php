<div class="row">
    <div class="col-lg-6">
        <form action="{{ isset($group->id) ? route('groups.update',$group->id) : route('groups.store') }}" method="post">
            @csrf
            @if (isset($group->id))
                @method('put')
            @endif
            <input type="text" class="form-control" name="name"
                   id="name" placeholder="Введите название группы" value="{{ isset($group->id) ? $group->name : old('name') }}">
            <br>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary btn-sm">{{ isset($group->id) ? 'Изменить' : 'Создать' }}</button>
        </form>
    </div>
</div>

