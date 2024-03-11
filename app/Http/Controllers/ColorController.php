<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\Row;
use App\Models\Color;
use Illuminate\Http\Request;
use LaravelLang\NativeCountryNames\Enums\SortBy;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin.color.index');
    }
    public function edit(Color $color)
    {

    }
    public function upload(Request $request,$id)
    {
        $product = Product::find($id);
        $file = $request->file('file');
        $fileName = time().'-'.$file->getClientOriginalName();
        $file->storeAs('image/lodomens/', $fileName, 'public');
        $rowValue = $request->row;
            // Buscar y eliminar la imagen existente si los valores coinciden
            $existingImage = $product->images()
            ->where('color_id', $request->colorid)
            ->whereHas('rows', function ($query) use ($rowValue) {
                $query->where('row_id', $rowValue);
            })
            ->where('imageable_id', $id)
            ->first();
            if ($existingImage) {
                // Eliminar la imagen existente
                $filePath = storage_path('app/public/'.$existingImage->url);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $existingImage->delete();
            }
        $image=$product->images()->create([
            'url' => 'image/lodomens/'. $fileName,
            'color_id' => $request->colorid,
            'imageable_type'=>'App\Models\Product',
            'imageable_id'=>$id,
        ]);
                //verificar fila
                $numberArray = $product->images->pluck('row_image.row_id')->unique()->count();
                if ($numberArray === 0) {
                    $row=Row::create([
                        'order' => '0',
                    ]);
                } else{
                    $row=Row::find($request->row);
                }
        $row->images()->attach($image->id);
    }
    public function getimage(Request $request)
    {
        $colorId = $request->colorid;
        $rowId = $request->row;
        $url = Image::whereHas('rows', function ($query) use ($rowId, $colorId) {
            $query->where('row_id', $rowId)->where('color_id', $colorId);
        })->pluck('url');
            return response()->json(['url' => $url]);
    }
    public function sorting(Request $request,$id)
    {
        $orders = explode(",", $request->order);
        $product = Product::find($id);
        $rows = Row::whereHas('images', function ($query) use ($product) {
            $query->where('imageable_id', $product->id)
                ->where('imageable_type', get_class($product));
        })->get()->keyBy('id');
        // Recorre los ID en el orden proporcionado
        foreach ($orders as $key => $order) {
            $row = $rows[$order];
            $row->order = $key;
            $row->save();
        }
    }
    public function addrow(Request $request)
    {
        $row=Row::create([
            'order'=>$request->order,
        ]);
        return response()->json(['row_id'=>$row->id,'order'=>$row->order]);
    }
}
