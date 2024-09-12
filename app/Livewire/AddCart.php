<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Color;
use Cart;
use Livewire\Attributes\On;
class AddCart extends Component
{
    public $sku; public $limit;
    public $product; public $showCreateModal = false;
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
            ['productImage' => $product->images->where('color_id',$color)->first()->url ?? 'image/dashboard/No_image_dark.png',
            'brand'=>$product->brand->name,
            'slug'=> $product->slug,
            'sku'=>$sku->code,
            'color'=>$sku->color->name,
            'color_id'=>$sku->color_id,
            'stock'=>$sku->stock,
            'hex'=> $product->type->hex,
            'src'=> $product->type->src,
            ]
        )->associate('App\Models\Sku');
            if(auth()->user()){
            Cart::instance('cart')->store(auth()->user()->id);}
        $this->dispatch('cart-added');
        $this->redirectRoute('web.shop.cart.index');
    }
    #[On('add-wishlist')]
    public function addwish($color)
    {
        if(auth()->user()){
            $product = Product::with('images')->find($this->product);
            $sku = Sku::where(['product_id'=>$product->id, 'color_id' =>$color])->first();
            Cart::instance('wishlist')->add(
                $product->id,
                $product->name,
                1,
                $sku->sell_price,
                ['productImage' => $product->images->where('color_id',$color)->first()->url ?? 'image/dashboard/No_image_dark.png',
                'brand'=>$product->brand->name,
                'slug'=> $product->slug,
                'sku'=>$sku->code,
                'color'=>$sku->color->name,
                'color_id'=>$sku->color_id,
                'stock'=>$sku->stock,
                'hex'=> $product->type->hex,
                'src'=> $product->type->src,
                ]
            )->associate('App\Models\Sku');
                Cart::instance('wishlist')->store(auth()->user()->id);
            $this->dispatch('wishlist-added');
        }
        else{
            $this->showCreateModal= true;
        }
    }

}
