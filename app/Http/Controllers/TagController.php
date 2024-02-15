<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:tags.index',
            'permission:tags.create',
            'permission:tags.store',
            'permission:tags.edit',
            'permission:tags.update',
            'permission:tags.destroy',
        ]);
    }
    public function index()
    {
        $tags = Tag::get();
        return view('admin.tag.index', compact('tags'));
    }
    public function type($type)
    { 
        return view('admin.tag.index', compact('type'));
    }
    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request, Tag $tag)
    {
        $rules = [
            'name'=>'required|unique:tags|string|max:255',
            'description'=>'required|string|max:255',
            ];
            $messages = [
                'name.unique'=>'El nombre "'.$request->name.'" ya fue registrado',
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails())
        {
            return redirect()->route('tags.create')->withErrors($validator);
        }
        else{
            $tag->my_store($request);
            return redirect()->route('tags.index')->with('toast_success', '¡Etiqueta "'.$request->name.'" creada con éxito!');
        }
    }

    public function show(Tag $tag)
    {
        return view('admin.tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {   $rules = [
        'name'=>'required|unique:tags|string|max:255',
        'description'=>'required|string|max:255',
        ];
        $messages = [
            'name.unique'=>'El nombre "'.$request->name.'" ya fue registrado',
        ];
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails())
    {   $id_tag=$tag->id;
        return redirect()->route('tags.index')->with( ['id_tag' => $id_tag] )->withErrors($validator);
    }
    else{
        $tag->my_update($request);
        return redirect()->route('tags.index')->with('toast_success', '¡Etiqueta actualizada con éxito!');
    }
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('toast_success', '¡Etiqueta eliminada con éxito!');
    }
}
