<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'hex',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
    public function images(){
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('hex','like',"%{$value}%");
         /* ->orWhereHas('roles', function ($roleQuery) use ($value) {
            $roleQuery->where('name', 'like', "%{$value}%");
        });
       ->orWhere('updated_at','like',"%{$value}%"); */
    }
}
