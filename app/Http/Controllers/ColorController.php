<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use App\Models\Row;
use Illuminate\Http\Request;
use LaravelLang\NativeCountryNames\Enums\SortBy;

class ColorController extends Controller
{
    public function upload(Request $request,$id)
    {
        $product = Product::find($id);
        $file = $request->file('file');
        $fileName = time().'-'.$file->getClientOriginalName();
        $file->storeAs('image/lodomens/', $fileName, 'public');
        //verificar fila
        $hasRow = $product->images->doesntContain('row_id');
        if ($hasRow) {
            $row=Row::create([
                'order' => '0',
            ]);
        }
            // Buscar y eliminar la imagen existente si los valores coinciden
            $existingImage = $product->images()->where('row_id', $row->id)
                                                ->where('color_id', $request->colorid)
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
        $product->images()->create([
            'url' => 'image/lodomens/'. $fileName,
            'row_id' => $row->id,
            'color_id' => $request->colorid,
            'imageable_type'=>'App\Models\Product',
            'imageable_id'=>$id,
        ]);
    }
    public function getimage(Request $request)
    {
        $url = Image::where('imageable_id', $request->imageable_id)
            ->where('row_id', $request->order)
            ->where('color_id', $request->colorid)
            ->pluck('url');
            return response()->json(['url' => $url]);
    }
    public function sorting(Request $request,$id)
    {
        $orders = explode(",", $request->order);
        $product = Product::find($id);
        $images = $product->images->groupBy('order');
        foreach ($orders as $key => $order) {
            foreach ($images[$order] as $image) {
                $image->order = $key;
                $image->save();
            }
        }
    }

}
