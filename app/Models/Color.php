<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hex',
        'url'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
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
