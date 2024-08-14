<?php

namespace App\Livewire;

use App\Models\SaleOrder;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;
class WebPurchase extends Component
{
    use WithPagination;
    public $filterBy='created_at'; public $perPage = 5; public $open = ''; public $order_last = '';
    public function render()
    {
        return view('livewire.web-purchase',[
            'orders'=> SaleOrder::where('user_id',auth()->user()->id)
            ->orderBy($this->filterBy,'DESC')
            ->with('saleDetails')
            ->paginate($this->perPage),
            'dolar'=>Setting::where('name','dolares')->pluck('action')->first(),
        ]);
    }
    public function filter() { }
}
