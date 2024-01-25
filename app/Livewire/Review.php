<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Like;
use App\Models\Review as Comm;

class review extends Component
{
    public $reviewableType; // Tipo de modelo al que se relacionará (por ejemplo, 'Product')
    public $reviewableId;   // ID del modelo al que se relacionará
    public $star ='';
    public $review ='';
    public $review2 ='';
    public $score;
    public $abc = '';

    public function addLike($id) {
        $like = Like::where([
            'user_id' => auth()->user()->id,
            'likeable_id' => $id,
            'likeable_type' => 'App\Models\review'
        ])->first();

        if (!$like) {
            Like::create([
                'user_id' => auth()->user()->id,
                'likeable_id' => $id,
                'likeable_type' => 'App\Models\review'
            ]);
        }
    }

    public function removeLike($id) {
       $like = Like::find($id);
       if($like) { $like->delete();}

    }


    public function save()
    {
       $comentario= Comm::create([
            'body' => $this->review,
            'user_id' => auth()->user()->id,
            'score' => $this->star,
        ]);
        $coo= Product::find($this->reviewableId);
        $coo->reviews()->save($comentario);
        $this->review ='';
    }
    public function rate($star){
        $this->star=$star;

    }
    public function sort($sort)
    {
        $this->score=$sort;
    }
    public function render()
    {
       /*  $abc = Product::find($this->reviewableId)
        ->reviews()
        ->latest()
        ->get(); */
        return view('livewire.review',([

            'co' => Product::find($this->reviewableId)
            ->reviews()
            ->when($this->score, function ($query, $score) {
                return $query->where('score', $score);
            })->latest()->get(),
            'total'=> Product::find($this->reviewableId)->reviews()->get()->count(),
            'five'=> Product::find($this->reviewableId)->reviews()->where('score',5)->count(),
            'for'=> Product::find($this->reviewableId)->reviews()->where('score',4)->count(),
            'three'=> Product::find($this->reviewableId)->reviews()->where('score',3)->count(),
            'two'=> Product::find($this->reviewableId)->reviews()->where('score',2)->count(),
            'one'=> Product::find($this->reviewableId)->reviews()->where('score',1)->count(),
            'average' => round(Product::find($this->reviewableId)
            ->reviews()
            ->latest()->get()->avg('score'), 1),
        ]));
    }
}
