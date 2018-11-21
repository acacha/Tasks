<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class TasquesController extends Controller
{
    public function index()
    {
        $tasks =  map_collection(Task::orderBy('created_at','desc')->get());
        $users = User::all();
        return view('tasques',compact('tasks','users'));
    }
}
