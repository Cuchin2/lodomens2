<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Color;
use App\Models\Material;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Row;
use App\Models\Setting;
use App\Models\Sku;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:products.index',
            'permission:products.edit'
        ]);

    }
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product=Product::create([
            'name' => $request->name,
            'slug' =>Str::slug( $request->name),
            'category_id' => $request->category_id,
        ]);
        return redirect()->view('admin.product.edit',['slug'=>$product->slug]);
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
        $brands = Brand::all()->pluck('name', 'id')->toArray();
        $types = Type::all()->pluck('name', 'id')->toArray();
        $materials = Material::all()->pluck('name', 'id')->toArray();
        $average=round($product->reviews()->latest()->get()->avg('score'), 1);
        //multiselect Tags
        $tagNames = Tag::pluck('name')->toArray();
        $tagSelect = $product->tags()->pluck('name')->toArray();
        //multiselect Colors
        $colorNames = Color::select('name', 'hex', 'colors.id')->get()->map(function ($color) {
            return ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
        })->values()->toArray();
        $colorSelect = $product->colors()->select('name', 'hex', 'colors.id')->get()->map(function ($color) {
            return ['name' => $color->name, 'hex' => $color->hex, 'id' => $color->id];
        })->values()->toArray();
        $colorUnSelect2 = array_udiff($colorNames, $colorSelect, function ($a, $b) {
            return $a['hex'] <=> $b['hex'];
        });
        $colorUnSelect=array_merge($colorUnSelect2);
        $imagenes = $product->images;
        $rowIds = $imagenes->pluck('id');
        $numberArray = Row::whereHas('images', function ($query) use ($rowIds) {
            $query->whereIn('image_id', $rowIds);
        })->orderBy('order', 'asc')->get();
        $status= [
            'DRAFT' => 'Borrador',
            'SHOP' => 'Publicado',
            'POS' =>  'Programado',
            'DISABLED' => 'Cancelado'
        ];
        return view('admin.product.edit', compact('status','product','categories','average','tagNames','tagSelect','colorNames','colorSelect','colorUnSelect','numberArray','brands','types','materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => ['required','numeric','max:9999',Rule::unique('products')->ignore($product->id)],
            'brand_id' => ['required'],
            'name' => ['required']
            // Añade aquí otras reglas de validación según sea necesario
        ], [
            'code.required' => 'El campo código es obligatorio.',
            'code.integer' => 'El campo código debe ser númerico.',
            'code.max' => 'El campo código debe contener 4 dígitos.',
            'code.unique' => 'El código ya está en uso.',
            'brand_id.required' => 'Seleccione una marca.',
            'name.required'=>'El campo nombre es obligatorio'
            // Añade otros mensajes de error aquí
        ]);
        $request->merge(['id' => $product->id]);
        $product->my_update($request);
        $stock = $request->input('stock');
        if($request->input('colors') == null){
            Session::flash('mensaje', 'Selecione un color');
            return redirect()->route('inventory.products.edit',$product);
        }

        $sellPrices = $request->input('sell_price');
        if($sellPrices){
        foreach($sellPrices as $index => $price) {
            if ($price === null || $price == 0) {
                Session::flash('mensaje2', 'Seleccione un precio');
                return redirect()->route('inventory.products.edit', $product);
            }
        }}
        $skus= Sku::where('product_id',$product->id)->get();
        $usd=Setting::find(2)->action ?? '1';

        foreach ($skus as $index => $sku) {
            $sku->stock = $stock[$index] ?? '0';
            $sku->sell_price = $sellPrices[$index] ?? '0';
            $sku->usd = ($sellPrices[$index] ?? '0' )/$usd;
            $sku->save();
            }
        return redirect()->route('inventory.products.edit',$product)->with('info','Se actualizarón los datos del producto '.$product->name);
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
/*             $filePath = storage_path('app/public/'.$image->url);
            if (file_exists($filePath)) {
                unlink($filePath);
            } */
            $image->delete();
            return response()->json(['message' => 'La imagen se ha eliminado correctamente'], 200);
        }
        return response()->json(['message' => 'No se encontró la imagen'], 404);
    }
}
