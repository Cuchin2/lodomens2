<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
class Starmain extends Component
{
    public $product;
    #[On('star-rating')]
    public function updateRate(){

    }
    public function render()
    {
        $abc = Product::find($this->product);

        return view('livewire.starmain',[
            'star'=> round($abc->reviews->avg('score'), 1)*20,
        ]);
    }
}
