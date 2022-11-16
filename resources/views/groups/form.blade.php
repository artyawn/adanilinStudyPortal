
@section('form')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{route('groups.store')}}" method="post">
                @csrf
                <input type="text" class="form-control" name="name"
                       id="name" placeholder="Введите название группы">
                <br>
                <button type="submit" class="btn btn-primary btn-sm">Создать</button>
            </form>
        </div>
    </div>
@endsection
