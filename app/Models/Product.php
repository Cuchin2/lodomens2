<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
/* use Illuminate\Database\Eloquent\SoftDeletes; */
use App\Models\Rating;
use App\Models\Color;
use App\Models\Type;
use App\Models\Sku;
use App\Models\Material;
class Product extends Model implements CanVisit
{
    use HasFactory;
  /*   use SoftDeletes; */
    use HasVisits;
    protected $fillable = [
        'code',
        'name',
        'slug',
        'short_description',
        'body',
        'status',
        'views',
        'rating',
        'category_id',
        'brand_id',
        'provider_id',
        'type_id',
        'material_id',
        'sell_price'
    ];
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function add_stock($quantity){
        $this->increment('stock', $quantity);
    }
    public function subtract_stock($quantity){
        $this->decrement('stock', $quantity);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
       }
    public function order_details(){
        return $this->hasMany(SaleDetail::class);
    }
    public function promotions(){
        return $this->belongsToMany(Promotion::class);
    }

    public function similar()
    {
        return $this->store_products()->where( [
            ['category_id',$this->category_id],
            ['id','!=',$this->id]
        ])->inRandomOrder()->take(6)->get();
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function material(){
        return $this->belongsTo(Material::class);
    }
    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function comments(){
        return $this->morphToMany(Comment::class, 'commentable');
    }
    public function reviews(){
        return $this->morphToMany(Review::class, 'reviewable');
    }
    public function scopeSearch($query, $value)
    {
        // Mapeo de traducciones en español a los valores originales en la base de datos
        $statusMap = [
            'borrador' => 'DRAFT',
            'publicado' => 'SHOP',
            'cancelado' => 'DISABLED',
            'programado' => 'POS',
        ];

        // Convertimos la búsqueda a minúsculas y eliminamos espacios innecesarios
        $valueLower = mb_strtolower(trim($value));

        // Buscar coincidencias parciales en el statusMap
        $matchingStatuses = array_filter($statusMap, function ($key) use ($valueLower) {
            return stripos($key, $valueLower) !== false; // Devuelve true si encuentra coincidencia parcial
        }, ARRAY_FILTER_USE_KEY);

        // Obtener los valores de estado coincidentes
        $statusValues = array_values($matchingStatuses);

        $query->where(function ($q) use ($value, $statusValues) {
            $q->where('name', 'like', "%{$value}%")
              ->orWhereHas('type', function ($q) use ($value) {
                  $q->where('name', 'like', "%{$value}%");
              })
              ->orWhereHas('material', function ($q) use ($value) {
                  $q->where('name', 'like', "%{$value}%");
              })
              ->orWhereHas('category', function ($q) use ($value) {
                  $q->where('name', 'like', "%{$value}%");
              });

            // Si hay coincidencias en los estados, agregar condición OR en el WHERE
            if (!empty($statusValues)) {
                $q->orWhereIn('status', $statusValues);
            }
        });

        return $query;
    }



    public function my_update($request){
        $this->update($request->except('sell_price'));

        if ($request->tags !== NULL) {
            // Obtén el valor de tags como un solo string
            $tagsString = $request->get('tags');
            $a = [];
            // Divide el string de tags en un arreglo utilizando la coma como separador
            $tagsArray = explode(",", $tagsString);
            foreach ($tagsArray as $key => $value) {
                $tags = Tag::whereIn('name', [$value])->pluck('id');
                $a = array_merge($a, $tags->toArray());
            }
                $this->tags()->detach();
                $this->tags()->sync($a);
            }

            else {
                 // Verifica si hay etiquetas asociadas antes de realizar el detach
                    $this->tags()->detach();
            }

            if ($request->colors !== NULL) {
                // Obtén el valor de colors como un solo string
                $colorsString = $request->get('colors');
                $b = [];
                // Divide el string de colors en un arreglo utilizando la coma como separador
                $colorsArray = explode(",", $colorsString);
                foreach ($colorsArray as $key => $value) {
                    $colors = Color::whereIn('name', [$value])->pluck('id');
                    $b = array_merge($b, $colors->toArray());
                }
                $existingSkus = Sku::where('product_id', $request->id)->get();

                    $this->colors()->detach();
                    $this->colors()->sync($b);
                foreach ($existingSkus as $existingSku) {
                    if (!in_array($existingSku->color_id, $b)) {
                        $existingSku->delete();
                    }
                }
                $product= Product::find($request->id);

                foreach ($b as $colorId) {
                    $colorCode = Color::find($colorId);
                    Sku::updateOrCreate([
                        'color_id' => $colorId,
                        'product_id' => $request->id,
                        ],[
                        'product_id' => $request->id,
                        'color_id' => $colorId,
                        'brand_id' => $product->brand->id,
                        'category_id' => $product->category->id,
                        'code' => $product->brand->slug.str_pad($product->category->code,2, '0', STR_PAD_LEFT).str_pad($product->code, 4, '0', STR_PAD_LEFT).str_pad($colorCode->code, 2, '0', STR_PAD_LEFT),
                    ]);
                }
                $first_price=Sku::where(['product_id'=>$request->id,'color_id'=>$b[0]])->pluck('sell_price');
                $product->sell_price=$first_price[0];
                $product->save();
            }
                else {
                     // Verifica si hay etiquetas asociadas antes de realizar el detach
                        $this->colors()->detach();
                        Sku::where('product_id', $request->id)->delete();
                }


            }
            public function status(){
                switch ($this->attributes['status']) {
                    case 'DRAFT':
                        return 'Borrador';
                    case 'SHOP':
                        return 'Publicado';
                    case 'DISABLED':
                        return 'Cancelado';
                    case 'POS':
                            return 'Programado';
                    default:
                        return 'Borrador';
                }
            }
    /*
    public function my_store($request)
    {
        $product = self::create($request->all()+[
            'slug' => Str::slug($request->name, '_'),
        ]);
        $product->tags()->attach($request->get('tags'));
        $this->generate_code($product);
        $this->upload_files($request, $product);
        return $product;
    }



    }
    public function generate_code($product){
        $numero=$product->id;
        $numeroConCeros= str_pad($numero,8,"0", STR_PAD_LEFT);
        $product->update(['code' => $numeroConCeros]);
    }
    public function upload_files($request, $product){
       $urlimages=[] ;
       if($request->hasFile('images')){
           $images=$request->file('images');
           foreach ($images as $image) {
               $nombre= time().$image->getClientOriginalName();
               $ruta= public_path().'/image';
               $image->move($ruta,$nombre);
               $urlimages[]['url']='/image/'.$nombre;
           }
       }

       $product->images()->createMany($urlimages);
    }
    static function store_products(){
        return self::where('status','SHOP')
                    ->orwhere('status','BOTH');
    }
    static function pos_products(){
        return self::where('status', 'POS')
                    ->orWhere('status', 'BOTH');
    }
    public function getTotalDiscountedPercentageAttribute(){
        $total_amount = 0;
        $total_percentage = 0;
        foreach ($this->promotions as $key => $promotion) {
            if ($promotion->promotion_type == 'percent') {
                $total_percentage += $promotion->discount_rate;
            }elseif ($promotion->promotion_type == 'fixed_amount') {
                $total_amount += $promotion->fixed_amount_discount;
            }
        }
        if ($total_amount == 0) {
            return round(($total_percentage), 2);
        }else{
            return round(($total_percentage) + (100/($this->sell_price / $total_amount)), 2);
        }
    }
    public function getDiscountedPriceAttribute(){
        $total_percentage = 0;
        $total_amount = 0;
        foreach ($this->promotions as $key => $promotion) {
            if ($promotion->promotion_type == 'percent') {
                $total_percentage += $promotion->discount_rate;
            }elseif ($promotion->promotion_type == 'fixed_amount'){
                $total_amount += $promotion->fixed_amount_discount;
            }
        }
        $total = ($this->sell_price-($this->sell_price * ($total_percentage / 100))) - $total_amount;

        return round(($total), 2);
    }
    public function has_promotions(){
        $this->promotions;
        if ($this->promotions->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function product_status(){
        switch ($this->status) {
            case 'DRAFT':
                return 'BORRADOR';
                break;
            case 'SHOP':
                return 'TIENDA';
                break;
            case 'POS':
                return 'PUNTO DE VENTA';
                break;
            case 'BOTH':
                    return 'AMBOS';
                    break;
            case 'DISABLED':
                return 'DESACTIVADO';
                break;
            default:
                # code...
                break;
        }
    } */

}




