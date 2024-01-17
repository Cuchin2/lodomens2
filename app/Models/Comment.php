<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'likes',
        'user_id',
        'parent_id',
        'commentable_type',
        'commentable_id'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
     // Relación consigo mismo para respuestas a comentarios
     public function replies()
     {
         return $this->hasMany(Comment::class, 'parent_id');
     }
     public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
