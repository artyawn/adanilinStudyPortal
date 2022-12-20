<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>
<body>
    <div class="row">
    <div class="col-6">
    <h5>ФИО: {{ $user->fio }}</h5><br>
    <h5>Дата рождения: {{ $user->birth_date }}</h5>
    <h5>Группа: {{ $user->group->name }}</h5>
    <h5>Адрес: {{ $user->full_address }}</h5>
    <h5>Email: {{ $user->email }}</h5>
    <h5>Роль: {{ $user->role }}</h5>
    </div>
    <div class="col-6">
        <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">Предмет</th>
            <th scope="col">Оценка</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->pivot->score }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
</body>
</html>
