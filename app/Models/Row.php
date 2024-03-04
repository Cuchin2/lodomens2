<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $fillable =[
        'order'
    ];
    public function images()
    {
        return $this->belongsToMany(Image::class, 'row_image');
    }
}
