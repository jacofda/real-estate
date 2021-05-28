<?php

namespace Areaseb\Estate\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Areaseb\Estate\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::paginate(50);
        return view('estate::estate.tags.index', compact('tags'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request, Tag $tag)
    {

    }

    public function update(Request $request, Tag $tag)
    {

    }

    public function destroy(Tag $tag)
    {
        foreach($tag->properties as $property)
        {
            $property->$tag_id = null;;
        }
        $tag->delete();
        return 'done';
    }

}
