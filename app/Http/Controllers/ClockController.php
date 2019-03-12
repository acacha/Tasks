<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksIndex;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockController extends Controller
{
    public function index(Request $request)
    {
        return view('clock.index');
    }
}
