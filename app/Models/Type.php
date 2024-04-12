<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'hex',
        'description',
    ];
    public function getRouteKeyName(){
        return 'slug';
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function images(){
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('slug','like',"%{$value}%")
        ->orWhere('hex','like',"%{$value}%");
         /* ->orWhereHas('roles', function ($roleQuery) use ($value) {
            $roleQuery->where('name', 'like', "%{$value}%");
        });
       ->orWhere('updated_at','like',"%{$value}%"); */
    }
    use HasFactory;
}
