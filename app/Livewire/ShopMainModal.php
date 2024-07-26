<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Image;
use App\Models\Sku;
use Cart;
class ShopMainModal extends Component
{
    public $showModal = false; public $skus = ''; public $image=''; public $price_cart = '';
    public $counts = '1'; public $colorSelected= []; public $active = '0';
    public $showCreateModal = false; public $choose;
    public function render()
    {
        return view('livewire.shop-main-modal');
    }

    public function addToCart()
    {
        $product = $this->skus->product;
        $qtn= $this->counts;
        $price = $this->skus->sell_price;
        if(session('location') !== 'PE')
        { $price = $this->skus->usd; }
        if($this->choose === 'CART' ){
            Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $qtn,
            $price,
            ['productImage' => $this->image ?? 'image/dashboard/No_image_dark.png',
            'brand'=>$product->brand->name,
            'slug'=> $product->slug,
            'sku'=> $this->skus->code,
            'color'=> $this->skus->color->name,
            'color_id'=> $this->skus->color->id,
            'stock'=> $this->skus->stock]
        )->associate('App\Models\Sku');
        if(auth()->user()){
        Cart::instance('cart')->store(auth()->user()->id);}
        $this->redirectRoute('web.shop.cart.index');
        } else {
            Cart::instance('wishlist')->add(
                $product->id,
                $product->name,
                $qtn,
                $price,
                ['productImage' => $this->image ?? 'image/dashboard/No_image_dark.png',
                'brand'=>$product->brand->name,
                'slug'=> $product->slug,
                'sku'=> $this->skus->code,
                'color'=> $this->skus->color->name,
                'color_id'=> $this->skus->color->id,
                'stock'=> $this->skus->stock]
            )->associate('App\Models\Sku');
            Cart::instance('wishlist')->store(auth()->user()->id);
            $this->redirectRoute('web.shop.webdashboard.wishlist');
        }
    }

    #[On('show-cart-modal')]
    public function showCartModal($id, $color, $url, $colorSelected, $choose)
    {

        // Para depuración
        // dd($id, $color, $url, $colorSelected, $choose);
        $this->counts = 1;
        $this->active = 0;
        $this->skus = Sku::where(['product_id' => $id, 'color_id' => $color])->first();

        if (session('location') !== 'PE') {
            $this->skus->sell_price = $this->skus->usd;
        }

        $this->image = $url;
        $this->colorSelected = json_decode($colorSelected);
        $this->price_cart = $this->skus->sell_price;
        $this->choose = $choose;
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
        if(session('location') !== 'PE')
        { $this->skus->sell_price = $this->skus->usd; }
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
        ->first()->url ?? '/image/dashboard/No_image_dark.png';
        if(session('location') !== 'PE')
        { $this->skus->sell_price = $this->skus->usd; }
        $this->price_cart= $this->skus->sell_price;
    }
    public function showWishlistModal()
    {
        $this->showCreateModal= true;
    }
}
