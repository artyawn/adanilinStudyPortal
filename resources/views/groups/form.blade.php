<div class="row">
    <div class="col-lg-6">
        <form action="{{ $action }}" method="post">
            @csrf
                @method($method)
            <input type="text" class="form-control" name="name"
                   id="name" placeholder="Введите название группы" value="{{ $value }}">
            <br>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
        </form>
    </div>
</div>


