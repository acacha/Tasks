<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsIndex;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagsIndex $request)
    {
        $tags = map_collection(Tag::all());
        return view('tags',[
            'tags' => $tags
        ]);
    }

}
