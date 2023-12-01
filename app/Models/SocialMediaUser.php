<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaUser extends Model
{
    protected $fillable = [
        'url',
        'name',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function my_store($request){
        $this->create($request->all());
    }
    public function my_update($request){
        $this->update($request->all());
    }
    use HasFactory;
}
