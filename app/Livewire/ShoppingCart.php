<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;
class ShoppingCart extends Component
{
    public function render()
    {
        return view('livewire.shopping-cart',[
            'cartitems'=>Cart::instance('cart')->content(),
            ]);
    }
    public function removeRow($rowId){
        Cart::instance('cart')->remove($rowId);
        $this->dispatch('cart-added');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('cart-added');
    }
    public function updateCart($rowId,$quantity)
    {
        Cart::instance('cart')->update($rowId,$quantity);
    }
}
