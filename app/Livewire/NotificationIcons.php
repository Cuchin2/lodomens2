<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;
use Livewire\Attributes\On;
class NotificationIcons extends Component
{
    public $cart; public $wishlist;
    public function render()
    {
        return view('livewire.notification-icons');
    }
    #[On('cart-added')]
    public function updateCartCount()
    {
        $this->cart= Cart::instance('cart')->content()->count();
    }
    #[On('wishlist-added')]
    public function updateWishlistCount()
    {
        $this->wishlist= Cart::instance('wishlist')->content()->count();
    }
}
