<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Cart;
class ShopMain extends Component
{
    use WithPagination;
    public $perPage = 5;
    #[Url(history:true)]
    public $search = '';
    #[Url(history:true)]
    public $type = '';
    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';
    public function updatedSearch()
    {
        $this->resetPage();
    }    public function render()
    {
        return view('livewire.shop-main',[
            'products' => Product::search($this->search)
            ->when($this->type !== '',function($query){
                $query->where('name',$this->type);
            })
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage),
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'productsall'=> Product::all(),
        ]);
    }
    public function addToCart($id)
    {
        $product = Product::with('images')->find($id); $qtn=1;

        $price = $product->sell_price /* ? $product->sale_price : $product->regular_price */;
        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $price,
            ['productImage' => $product->images->first()->url]
        )->associate('App\Models\Product');
        $this->dispatch('cart-added');
    }
}
