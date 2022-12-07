 <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('subjects.index') }}" class="nav-link px-2 link-dark">Предметы</a></li>
                    <li><a href="{{ route('groups.index') }}" class="nav-link px-2 link-dark">Группы</a></li>
                    <li><a href="{{ route('users.index') }}" class="nav-link px-2 link-dark">Студенты</a></li>
                    <li><a href="{{ route('gradebook.index') }}" class="nav-link px-2 link-dark">Журнал оценок</a></li>
                </ul>
                <div class="col-md-4 text-end">
                        <a class="nav-link px-2 link-dark">{{ Auth::user()->fio }}</a>
                </div>
     <div class="dropdown">
         <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
         </button>
         <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
             <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Профиль</a></li>
             <li><form action="{{ route('logout') }}" method="post">
                     @method('post')
                     @csrf
                     <button type="submit" class="btn btn-primary btn-sm">Выйти</button>
                 </form></li>
         </ul>
     </div>
            </header>
