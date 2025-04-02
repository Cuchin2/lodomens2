<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleNotes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'dashorder_id',
        'user_id'
    ];
    public function SaleDashOrder()
    {
        return $this->belongsTo(SaleDashOrder::class, 'dashorder_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
