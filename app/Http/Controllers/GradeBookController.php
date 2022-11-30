<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use App\Service\GradeBookService;
use Illuminate\Http\Request;

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
