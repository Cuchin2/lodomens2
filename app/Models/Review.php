<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'body',
        'score',
        'user_id',
        'commentable_type',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviewable()
    {
        return $this->morphTo();
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
