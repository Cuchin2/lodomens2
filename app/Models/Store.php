<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Store extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'phone',
        'address',
        'description',
    ];
    use HasFactory;
    public function skus()
    {
        return $this->belongsToMany(Sku::class)
                    ->withPivot('stock')
                    ->withTimestamps();
    }
    public function deleteWithSkus()
    {
        // Usamos una transacción para garantizar que ambas operaciones se completen correctamente
        return DB::transaction(function () {
            $this->skus()->detach();
            // Eliminar las relaciones en la tabla transfer_skus
        });
    }
}
