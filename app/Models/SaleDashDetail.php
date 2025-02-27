<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDashDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'brand',
        'slug',
        'qtn',
        'sell_price',
        'productImage',
        'category',
        'sku',
        'color',
        'order_dash_id',
        'hex',
        'src',
    ];

    public function order()
    {
        return $this->belongsTo(SaleDashOrder::class, 'order_dash_id');
    }
}
