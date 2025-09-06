<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Returnn extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'store_id',
        'observations',
        'status'
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
    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'returnn_skus')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function TransferNotes()
    {
        return $this->hasOne(ReturnnNote::class,'returnn_id');
    }
    public function details()
    {
        return $this->hasMany(ReturnnDetail::class, 'returnn_id');
    }
        // Método para eliminar la transferencia y sus SKUs asociados
        public function deleteWithSkus()
        {
            // Usamos una transacción para garantizar que ambas operaciones se completen correctamente
            return DB::transaction(function () {
                $this->skus()->detach();
                // Eliminar las relaciones en la tabla transfer_skus
            });
        }
    public function scopeSearch($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->whereHas('user', function ($userQuery) use ($value) {
                $userQuery->where('name', 'like', "%{$value}%");
            })
            ->orWhereHas('store', function ($storeQuery) use ($value) { // Cambiado a orWhereHas y renombrada la variable
                $storeQuery->where('name', 'like', "%{$value}%");
            })
            ->orWhere('status', 'like', "%{$value}%")
            ->orWhere('created_at', 'like', "%{$value}%");
        });
    }
}
