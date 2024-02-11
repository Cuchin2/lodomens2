<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Rating;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'stock',
        'sell_price',
        'short_description',
        'body',
        'status',
        'views',
        'rating',
        'category_id',
        'brand_id',
        'provider_id',
    ];
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function add_stock($quantity){
        $this->increment('stock', $quantity);
    }
    public function subtract_stock($quantity){
        $this->decrement('stock', $quantity);
    }
    public function brands(){
        return $this->belongsTo(Brand::class);
       }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
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
        $query->where('name','like',"%{$value}%")
        ->orWhere('sell_price','like',"%{$value}%");
         /* ->orWhereHas('roles', function ($roleQuery) use ($value) {
            $roleQuery->where('name', 'like', "%{$value}%");
        });
       ->orWhere('updated_at','like',"%{$value}%"); */
    }
    public function my_update($request){
        $this->update($request->all());

        if ($request->tags !== NULL) {
            // Obtén el valor de tags como un solo string
            $tagsString = $request->get('tags');

            // Divide el string de tags en un arreglo utilizando la coma como separador
            $tagsArray = explode(",", $tagsString);

                // Busca las etiquetas correspondientes a los nombres
                $tagIds = Tag::whereIn('name', $tagsArray)->pluck('id')->toArray();

                // Sincroniza las etiquetas utilizando los IDs encontrados
                $this->tags()->sync($tagIds);
            }

            else {
                 // Verifica si hay etiquetas asociadas antes de realizar el detach
                    $this->tags()->detach();
            }
            /* $this->tags()->sync($request->get('tags')); */
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




