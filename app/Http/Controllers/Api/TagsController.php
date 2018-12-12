<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagsDestroy;
use App\Http\Requests\TagsIndex;
use App\Http\Requests\TagsShow;
use App\Http\Requests\TagsStore;
use App\Http\Requests\TagsUpdate;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{

    public function index(TagsIndex $request)
    {
        return map_collection(Tag::orderBy('created_at')->get());
    }

    public function show(TagsShow $request, Tag $tag) // Route Model Binding
    {
        return $tag->map();
    }

    public function destroy(TagsDestroy $request, Tag $tag)
    {
        $tag->delete();
        return $tag;
    }

    public function store(TagsStore $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }

    public function update(TagsUpdate $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }

}
