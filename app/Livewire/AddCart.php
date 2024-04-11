<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Color;
use Cart;
class AddCart extends Component
{
    public $sku; public $count = 0;
    public $product;
    public $color;
    public function render()
    {
        return view('livewire.add-cart');
    }
    public function add($qtn,$color)
    {
        $product = Product::with('images')->find($this->product);
        $sku = Sku::where(['product_id'=>$product->id, 'color_id' =>$color])->first();
        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $sku->sell_price,
            ['productImage' => $product->images->where('color_id',$color)->first()->url,
            'slug'=> $product->slug,
            'sku'=>$sku->code,
            'color'=>$sku->color->name,
            'color_id'=>$sku->color_id,
            'stock'=>$sku->stock
            ]
        )->associate('App\Models\Sku');
            if(auth()->user()){
            Cart::instance('cart')->store(auth()->user()->id);}
        $this->dispatch('cart-added');
        $this->redirectRoute('cart.index');
    }
}
