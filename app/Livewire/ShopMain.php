<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Sku;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Cart;
class ShopMain extends Component
{
    use WithPagination;
    public $showModal = false; public $skus = ''; public $image=''; public $price_cart = '';
    public $perPage = 5; public $counts = '1'; public $colorSelected= []; public $active = '0';
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
    public function addToCart()
    {
        $product = $this->skus->product;
        $qtn= $this->counts;
        $price = $this->skus->sell_price;

       $cart= Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $price,
            ['productImage' => $this->image,
            'slug'=> $product->slug,
            'sku'=> $this->skus->code,
            'color'=> $this->skus->color->name,
            'color_id'=> $this->skus->color->id,
            'stock'=> $this->skus->stock]
        )->associate('App\Models\Sku');
        if(auth()->user()){
        Cart::instance('cart')->store(auth()->user()->id);}
        $this->redirectRoute('cart.index');
    }
    public function showCartModal($id,$color,$url,$colorSelected)
    {   $this->counts= 1; $this->active =0;
        $this->skus= Sku::where(['product_id'=>$id,'color_id'=>$color])->first();
        $this->image= $url;
        $this->colorSelected= json_decode($colorSelected);
        $this->price_cart= $this->skus->sell_price;
        $this->showModal = true;
    }
    public function decreaseCount($rowId,$index)
    {

            $this->counts--; $this->changePrice();
            // Lógica adicional si es necesario
    }

    public function increaseCount($rowId,$index)
    {

            $this->counts++; $this->changePrice();
    }
    public function changePrice()
    {   if (!is_numeric($this->counts) || $this->counts < 1) { $this->counts = 1; }
        else  {
            if(($this->counts > $this->skus->stock))
            {$this->counts = $this->skus->stock; }
        };
        $this->price_cart= number_format($this->counts*$this->skus->sell_price, 2, '.', '');
    }
    public function changeColor($key,$id,$color)
    {
        $this->active = $key;  $this->counts=1;
        $this->skus= Sku::where(['product_id'=>$id,'color_id'=>$color])->first();
        $this->image = Image::join('row_image', 'images.id', '=', 'row_image.image_id')
        ->join('rows', 'rows.id', '=', 'row_image.row_id')
        ->where('color_id', $color)
        ->where('rows.order', 0)
        ->where('images.imageable_id', $id) // Agrega esta línea
        ->first()->url;
        $this->price_cart= $this->skus->sell_price;
    }

}
