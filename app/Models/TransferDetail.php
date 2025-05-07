<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferDetail extends Model
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
        'transfer_id',
        'hex',
        'src',
    ];

    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'transfer_id');
    }
}
