<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'transfer_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class,'transfer_id');
    }

}
