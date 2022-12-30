<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GradeBookService;

class GradeBookController extends Controller
{
    public function index(GradeBookService $service)
    {
        $users = User::paginate(10);
        $subjects = $service->subjects();
        $average = $service->average();
        $good_users = $service->goodUsers();
        $best_users = $service->bestUsers();

        return view('book.index', compact('subjects', 'users', 'average', 'good_users', 'best_users'));
    }
}
