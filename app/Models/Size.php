<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name', 'type', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // Scope para filtrar tallas por la marca activa del usuario (útil en el panel)
    public function scopeForCurrentBrand($query)
    {
        if (auth()->check() && auth()->user()->brand_id) {
            return $query->where('brand_id', auth()->user()->brand_id)
                         ->orWhereNull('brand_id'); // Incluye tallas globales
        }
        return $query;
    }
}
