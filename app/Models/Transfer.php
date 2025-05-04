<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'observations',
    ];

    // Usuario que hizo la transferencia
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tienda a la que se transfirió
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
