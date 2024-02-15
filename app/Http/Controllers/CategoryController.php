<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:categories.index',
            'permission:categories.create',
            'permission:categories.store',
            'permission:categories.show',
            'permission:categories.edit',
            'permission:categories.update',
            'permission:categories.destroy'
        ]);
    }
    public function index()
    {
        $categories = Category::all();
        $category_type= 'PRODUCT';
        return view('admin.category.index', compact('categories','category_type'));
    }

    public function create(Request $request)
    {
        $category_type = $request->a;
        $categories = Category::where('category_type',$category_type)->get();
        return view('admin.category.create',compact('category_type','categories'));
    }
    public function create_post()
    {

        $categories = Category::where('category_type','POST')->get();
        return view('admin.category.create',compact('categories'));
    }
    public function store(Request $request, Category $category)
    { $type = $request->category_type;

        $rules = [
            /* 'name'=>'required|unique:tags|string|max:255', */
            'name'=>['required', 'string', 'max:255',Rule::unique('categories')->where(function ($query) use ($request) {
                return $query->where('category_type', $request->category_type);
            })],
            'description'=>'required|string|max:255',
            ];
            $messages = [
                'name.unique'=>'El nombre "'.$request->name.'" ya fue registrado',
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails())
        {
            return redirect()->route('categories.create')->withErrors($validator);
        }
        else{
            $category->my_store($request,$type);
        return redirect()->route($type.".categories")->with('toast_success', '¡Categoría "'.$request->name.'" creada con éxito!');
        }

        /* return redirect()->route('categories.index'); */
    }

    public function show(Category $category)
    {
        /* $subcategories=$category->subcategories; */
            if($category->category_type == 'PRODUCT'){
            $category_type= $category->products;}

            if($category->category_type == 'POST'){
                $category_type= $category->posts;}

        return view('admin.category.show', compact('category','category_type'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            /* 'name'=>'required|unique:tags|string|max:255', */
            'name'=>['required', 'string', 'max:255',Rule::unique('categories')->where(function ($query) use ($request) {
                return $query->where('category_type', $request->category_type);
            })],
            'description'=>'required|string|max:255',
            ];
            $messages = [
                'name.unique'=>'El nombre "'.$request->name.'" ya fue registrado',
            ];
            $validator = Validator::make($request->all(), $rules,$messages);
            if ($validator->fails())
        {
            return redirect()->route('categories.edit',$category)->withErrors($validator);
        }
        else{
            $category->my_update($request);
            return redirect()->route("categories.".$category->category_type)->with('toast_success', '¡Categoría "'.$request->name.'" editada con éxito!');
        }
        /* $category->my_update($request); */


    }

    public function destroy(Category $category)
    {   $type=$category->category_type;
        $category->delete();

        return redirect()->route("categories.".$type)->with('toast_success', '¡Categoría eliminada con éxito!');

    }
}
