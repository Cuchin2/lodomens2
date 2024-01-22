<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable=[
        'ratings',
        'user_id',
        'rateable_id',
        'rateable_type'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rateable()
    {
        return $this->morphTo();
    }
}
