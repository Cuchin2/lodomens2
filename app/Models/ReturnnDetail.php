<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnnDetail extends Model
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
        'returnn_id',
        'hex',
        'src',
    ];

    public function returnn()
    {
        return $this->belongsTo(Returnn::class, 'returnn_id');
    }
}
