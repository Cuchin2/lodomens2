<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'code',
        'slug',
        'description',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function subcategoriesfather(){
        return $this->belongsTo(Category::class,'parent_id');
    }
    public function my_store($request, $type)
    {
        self::create($request->all()+[
            'slug' => Str::slug($request->name, '_'),
            'category_type' => $type,

        ]);
    }
    public function my_update($request)
    {
        $this->update($request->all()+[
                'slug' => Str::slug($request->name, '_'),
            ]);
    }
    public function products_count(){

        $total= self::descendantsAndSelf($this->id)->count();

        return $total;
    }

    public function translate(){
        switch ($this->category_type) {
            case 'PRODUCT':
                return 'producto';
                break;
            case 'POST':
                return 'blog';
                break;

            default:
                # code...
                break;
        }
    }
    public function item_numbers(){
        $total=0;

          $total += $this->products()->count();
           if ($total== 1) {
            return '('.$total.') publicación';
           }
          return '('.$total.') publicaciones';

        if($this->category_type == ''){
            return '('.$total.') '.$this->subcategoriesfather->translate();
        }

    }
    public function scopeSearch($query, $value)
    {
        $query->where('name','like',"%{$value}%")
        ->orWhere('description','like',"%{$value}%")
        ->orWhere('code','like',"%{$value}%");
    }
    use HasFactory;

}
