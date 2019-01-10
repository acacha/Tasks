<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoggedUserPhotoController extends Controller
{

    public function show(Request $request)
    {
        $photo = $this->userPhotoExists($request->user()) ? $request->user()->photo : $this->defaultPhoto();
        return response()->file(Storage::disk('local')->path($photo->url));
    }


    protected function userPhotoExists($user)
    {
        return $user->photo && Storage::disk('local')->exists($user->photo->url);
    }

    protected function defaultPhoto()
    {
        return 'photos/default.png';
    }
}
