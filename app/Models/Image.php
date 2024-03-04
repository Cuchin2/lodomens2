<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'row_id',
        'color_id'
        ];
    public function imageable(){
        return $this->morphTo();
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function rows()
    {
        return $this->belongsToMany(Row::class, 'row_image');
    }
    use HasFactory;
}
