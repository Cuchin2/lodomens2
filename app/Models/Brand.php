<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Image;
class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function my_store($request)
    {
        $brand=self::create($request->all()+[
            'slug' => Str::slug($request->name, '_'),

        ]);
        $image=$request->file('file');
        $nombre= time().$image->getClientOriginalName();
        $urlimages='/image/'.$nombre;
        $formatted_image=Image::make($image);
        $formatted_image->fit(160,65);
        $formatted_image->save(public_path('/image/'.$nombre));

        $brand->images()->create([
            'url' => $urlimages,
        ]);

    }
    public function my_update($request)
    {
        $this->update($request->all()+[
            'slug' => Str::slug($request->name, '_'),
        ]);

         if($request->hasFile('file')){
                $image=$request->file('file');
                $nombre= time().$image->getClientOriginalName();

                $urlimages='/image/'.$nombre;

                $formatted_image=Image::make($image);
                $formatted_image->fit(160,65);
                $formatted_image->save(public_path('/image/'.$nombre));

                $this->images()->update([
                    'url' => $urlimages,
                ]);
        }

    }
    use HasFactory;
}
