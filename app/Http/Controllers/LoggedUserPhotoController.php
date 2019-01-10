<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoggedUserPhotoController extends Controller
{

    public function show(Request $request)
    {
        $photo = $this->userPhotoExists($request->user()) ? $request->user()->photo : $this->defaultPhoto();
        return response()->file(storage_path('app/' . $photo));
    }

    protected function userPhotoExists($user)
    {
        return $user->photo && Storage::exists($user->photo);
    }

    protected function defaultPhoto()
    {
        return 'photos/default.png';
    }
}
