<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'order'
        ];
    public function imageable(){
        return $this->morphTo();
    }
    use HasFactory;
}
