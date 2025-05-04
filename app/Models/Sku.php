<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Location\Facades\Location;
class Sku extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_id',
        'category_id',
        'brand_id',
        'code',
        'stock',
        'sell_price',
        'usd',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }
    public function stores()
    {
        return $this->belongsToMany(Store::class)
                    ->withPivot('stock')
                    ->withTimestamps();
    }
}
