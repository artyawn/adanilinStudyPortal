 <div class="row">
        <div class="col-lg-6">
            <form action="{{ isset($subject->id) ? route('subjects.update',$subject->id) : route('subjects.store') }}" method="post">
                @csrf
                @if (isset($subject->id))
                        @method('put')
                @endif
                <input type="text" class="form-control" name="name"
                       id="name" placeholder="Введите название предмета" value="{{ isset($subject->id) ? $subject->name : old('name') }}">
                <br>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm">{{ isset($subject->id) ? 'Изменить' : 'Создать' }}</button>
            </form>
        </div>
    </div>

