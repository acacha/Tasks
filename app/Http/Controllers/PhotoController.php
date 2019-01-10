<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photos\PhotoStore;
use App\Photo;

class PhotoController extends Controller
{

    public function store(PhotoStore $request)
    {
        //CustomFileName with extension
        $extension = $request->file('photo')->getClientOriginalExtension();
        $path = $request->file('photo')->storeAs(
            'photos', $request->user()->id. '.'. $extension
        );
        return Photo::create([
            'url' => $path,
            'user_id' => $request->user()->id
        ]);
    }

    public function storeExamples(PhotoStore $request)
    {
        //Nom definit per Laravel amb un sistema per evitar colisions:
        $path = $request->file('photo')->store('photos');
//        $path = Storage::putFile('photos', $request->file('photo'));
        //CustomFileName
        $path = $request->file('photo')->storeAs(
            'photos', $request->user()->id
        );
        //CustomFileName with extension
        $path = $request->file('photo')->storeAs(
            'photos', $request->user()->id
        );
        // Specificar un disk
//        $path = $request->file('photo')->store(
//            'photos/'.$request->user()->id, 's3'
//        );
        dump($path);
        return Photo::create([
            'url' => $path
        ]);
    }
}
