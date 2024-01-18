<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Like;
use App\Models\Comment as Comm;

class Comment extends Component
{


    public $commentableType; // Tipo de modelo al que se relacionará (por ejemplo, 'Product')
    public $commentableId;   // ID del modelo al que se relacionará

    public $comment ='';
    public $comment2 ='';

    public function addLike($id) {
        $like = Like::where([
            'user_id' => auth()->user()->id,
            'likeable_id' => $id,
            'likeable_type' => 'App\Models\Comment'
        ])->first();

        if (!$like) {
            Like::create([
                'user_id' => auth()->user()->id,
                'likeable_id' => $id,
                'likeable_type' => 'App\Models\Comment'
            ]);
        }
    }

    public function removeLike($id) {
       $like = Like::find($id);
       if($like) { $like->delete();}

    }
    public function render()
    { $abc = Product::find($this->commentableId)->comments()->where('parent_id',null)->latest()->get();
        return view('livewire.comment',([
            'co' => $abc,
            'total'=> Product::find($this->commentableId)->comments()->get()->count(),
        ]));
    }
    public function save()
    {
       $comentario= Comm::create([
            'body' => $this->comment,
            'user_id' => auth()->user()->id,
            'parent_id' => null,

        ]);
        $coo= Product::find($this->commentableId);
        $coo->comments()->save($comentario);
        $this->comment ='';
    }
    public function save2($id)
    {
        $comentario= Comm::create([
            'body' => $this->comment2,
            'user_id' => auth()->user()->id,
            'parent_id' => $id,

        ]);
        $coo= Product::find($this->commentableId);
        $coo->comments()->save($comentario);
        $this->comment2 ='';
    }
    public function clean(){
        $this->comment2 ='';
    }
}
