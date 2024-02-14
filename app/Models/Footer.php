<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'logo',
        'email',
        'phone',
        'order_message',
        'address',
    ];
}
