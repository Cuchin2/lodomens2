<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Color;
use Cart;
class AddCart extends Component
{
    public $sku;
    public $product;
    public $color;
    public function render()
    {
        return view('livewire.add-cart');
    }
    public function add($qtn,$color)
    {
        $product = Product::with('images')->find($this->product);
        $price = $product->sell_price; $color2=Color::find($color);
        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $price,
            ['productImage' => $product->images->where('color_id',$color)->first()->url,
            'slug'=> $product->slug,
            'sku'=>Sku::where(['product_id'=>$product->id, 'color_id' =>$color])->first()->code,
            'color'=>$color2->name,
            'color_id'=>$color2->id
            ]
        )->associate('App\Models\Sku');
        $this->dispatch('cart-added');
        $this->redirectRoute('cart.index');
    }
}
