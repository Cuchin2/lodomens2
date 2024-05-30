<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',   		
        'slug',	
        'qtn',
        'sell_price',
        'productImage',
        'sku',
        'color',
        'color_id',
        'order_id'
    ];

    public function saleOrder()
    {
        return $this->belongsTo(SaleOrder::class,'order_id');
    }
}
