<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnnNote extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'description',
        'returnn_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function returnn()
    {
        return $this->belongsTo(Returnn::class,'returnn_id');
    }
}
