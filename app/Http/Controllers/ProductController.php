<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Image;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Can;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $average=round($product->reviews()->latest()->get()->avg('score'), 1);
        $tagNames = Tag::pluck('name')->toArray();
        $tagSelect = $product->tags()->pluck('name')->toArray();
        $tagUnselect =array_diff($tagNames,$tagSelect);

        return view('admin.product.edit', compact('product','categories','average','tagNames','tagSelect','tagUnselect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->my_update($request);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    public function getimages($id){
        $product= Product::find($id);
        $images = $product->images->sortBy('order')->values()->map(function ($image,$index) {
            $urlParts = explode('/', $image->url);
            $sizeInBytes = filesize('storage/'.$image->url);
            $sizeText = $sizeInBytes > 1024 ?
                ($sizeInBytes > 1048576 ?
                    round($sizeInBytes / 1048576) . " mb" :
                    round($sizeInBytes / 1024) . " kb") :
                $sizeInBytes . "b";
            $imageName = end($urlParts); // Obtener el nombre del archivo de la URL
            return (object)[
                'name' => $imageName, // Usar solo el nombre del archivo
                'url' => asset('storage/'.$image->url),
                'size' => $sizeText,
                'id'=> $image->id,
                'extension'=> File::extension(asset('storage/'.$image->url))
            ];
        });
        return response()->json($images);
    }
    public function addimages (Request $request,$id){
        $product= Product::find($id);
        $newOrder = count($product->images);
            $files = $request->file('files');
            foreach ($files as  $key => $file) {
                $fileName = time().'-'.$file->getClientOriginalName();
                $originalPath = 'storage/image/product/' . $fileName;
                // Almacena el archivo en el sistema de archivos
                $file->storeAs('image/lodomens/', $fileName, 'public');
                $product->images()->create([
                    'url' => 'image/lodomens/'. $fileName,
                    'order' =>$newOrder+$key,
                    'imageable_type'=>'App\Models\Product',
                    'imageable_id'=>$id
                ]);
            }
        return response()->json(['id'=>$id]);
    }
    public function handleReorder(Request $request,$id)
    {
        $images = Product::find($id)->images->keyBy('id');
        $orders = request('sorts');
        // Recorre los ID en el orden proporcionado
        foreach ($orders as $key => $order) {
            $image = $images[$order];
            $image->order = $key;
            $image->save();
        }
        return response()->json('se sorteo bien');
    }
    public function deleteimage($id)
    {
        $image = Image::find($id);
        if ($image) {
            $filePath = storage_path('app/public/'.$image->url);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
            return response()->json(['message' => 'La imagen se ha eliminado correctamente'], 200);
        }
        return response()->json(['message' => 'No se encontró la imagen'], 404);
    }
}
