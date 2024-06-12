<?php

namespace App\Livewire;

use App\Models\SaleOrder;
use Livewire\Component;

class WebPurchase extends Component
{
    public $filterBy='created_at';
    public function render()
    {
        return view('livewire.web-purchase',[
            'orders'=> SaleOrder::where('user_id',auth()->user()->id)
            ->orderBy($this->filterBy,'DESC')
            ->with('saleDetails')
            ->get(),
        ]);
    }
    public function filter() { }
}
