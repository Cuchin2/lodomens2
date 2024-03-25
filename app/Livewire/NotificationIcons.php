<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;
class NotificationIcons extends Component
{
    public $cart;
    public function render()
    {
        return view('livewire.notification-icons');
    }
    #[On('cart-added')]
    public function updateCartCount()
    {
        $this->cart= Cart::instance('cart')->content()->count();
    }
}
