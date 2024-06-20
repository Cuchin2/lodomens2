<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'url',
        'state',
        'body',
        'link',
        'order',
    ];
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('order','like',"%{$value}%")
        ->orWhere('state','like',"%{$value}%")
        ;
    }
    public function status(){
        switch ($this->attributes['state']) {
            case 'draft':
                return 'Borrador';
            case 'pos':
                    return 'Programado';
            default:
                return 'Publicado';
        }
    }
    use HasFactory;
}
