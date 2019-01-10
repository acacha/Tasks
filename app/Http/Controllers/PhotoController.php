<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photos\PhotoStore;
use App\Photo;

class PhotoController extends Controller
{

    public function store(PhotoStore $request)
    {
        $extension = $request->file('photo')->getClientOriginalExtension();
        $path = $request->file('photo')->storeAs(
            'photos', $request->user()->id. '.'. $extension
        );
//        $request->file('photo')->storeAs(
//            'photos/' .$request->user()->id. '.'. $extension,'google'
//        );
        if ($photo = Photo::where('user_id',$request->user()->id)->first()) {
            $photo->url = $path;
            $photo->save();
        } else {
            Photo::create([
                'url' => $path,
                'user_id' => $request->user()->id
            ]);
        }
        return back();
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
