<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDashOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'currency',
        'total',
        'name',
        'phone',
        'dni',
    ];

    public function details()
    {
        return $this->hasMany(SaleDashDetail::class, 'order_dash_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeSearch($query, $value)
    {
 /*        $query->where('name','like',"%{$value}%")
        ->orWhere('total','like',"%{$value}%")
        ->orWhere('status','like',"%{$value}%")
        ->orWhere('created_at','like',"%{$value}%"); */
        $query->where(function ($query) use ($value) {
            $query->whereHas('user', function ($userQuery) use ($value) {
                $userQuery->where('name', 'like', "%{$value}%");
            })
            ->orwhere('name','like',"%{$value}%")
            ->orWhere('total', 'like', "%{$value}%")
            ->orWhere('status', 'like', "%{$value}%")
            ->orWhere('created_at', 'like', "%{$value}%");
        });
    }
}
