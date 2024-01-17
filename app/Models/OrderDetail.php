<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'quantity',
        'price',
        'product_id',
     ];
     public function product(){
        return $this->belongsTo(Product::class)->withTrashed();
    }
    public function total(){
        return $this->quantity*$this->price;
    }
    use HasFactory;
}
