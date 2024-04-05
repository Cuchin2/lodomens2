<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;
class ShoppingCart extends Component
{
    public $counts = [];
    public function mount()
    {
        // Inicializar la lista de counts con los valores iniciales
        $cartitems = Cart::instance('cart')->content();
        foreach ($cartitems as $index => $item) {
            $this->counts[$index] = $item->qty;
        }
    }
    public function render()
    {
        return view('livewire.shopping-cart',[
            'cartitems'=>Cart::instance('cart')->content(),
            ]);
    }
    public function removeRow($rowId,$index){
                Cart::instance('cart')->remove($rowId);
                unset($this->counts[$index]);
                $this->dispatch('cart-added');
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('cart-added');
    }
    public function updateCart($rowId,$index)
    {
        Cart::instance('cart')->update($rowId,$this->counts[$index]);
    }
    public function decreaseCount($rowId,$index)
    {
        if (isset($this->counts[$index])) {
            $this->counts[$index]--;
            Cart::instance('cart')->update($rowId,$this->counts[$index]);
            // Lógica adicional si es necesario
        }
    }

    public function increaseCount($rowId,$index)
    {
        if (isset($this->counts[$index])) {

            $this->counts[$index]++;
            Cart::instance('cart')->update($rowId,$this->counts[$index]);
            // Lógica adicional si es necesario
        }
    }
}
