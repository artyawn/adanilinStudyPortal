<div class="row">
    <div class="col-lg-6">
        <form action="{{ $action }}" method="post">
            @csrf
            @method($method)
            @if (!isset($subject))
            <select class="form-select" name="subject_id" >
                @foreach($subjects as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <br>
            @error('subject_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                @error('subject')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif
            <input class="form-control" name="score"
                   id="score" placeholder="Введите оценку" value="{{ old('score', $subject->pivot->score ?? null) }}">
            <br>
            @error('score')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary btn-sm">Добавить</button>
        </form>
    </div>
</div>
