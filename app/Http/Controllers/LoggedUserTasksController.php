<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index()
    {
        $tasks = optional(Auth::user())->tasks;
        return view('tasks.user.index',compact('tasks'));
    }
}
