<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagsStore;
use App\Http\Requests\TagsUpdate;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{

    public function index(Request $request)
    {
        return Tag::orderBy('created_at')->get();
    }

    public function show(Request $request, Tag $tag) // Route Model Binding
    {
        return $tag->map();
    }

    public function destroy(Request $request, Tag $tag)
    {
          $tag->delete();
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
        $tag->save();
        return $tag->map();
    }

}
