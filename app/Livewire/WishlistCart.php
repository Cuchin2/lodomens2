<?php

namespace App\Livewire;
use App\Models\Sku;
use Cart;
use Livewire\Component;

class WishlistCart extends Component
{
    public $counts = []; public $showModal = false; public $row = []; public $choose = 0;
    public function mount()
    {
        // Inicializar la lista de counts con los valores iniciales
        $cartitems = Cart::instance('wishlist')->content();
        foreach ($cartitems as $index => $item) {
            $image= $item->options->productImage;
            $sku= Sku::where('code',$item->options->sku)->first();
            if(isset($sku)){
            $abc=Cart::instance('wishlist')->update($item->rowId,['price'=> $sku->sell_price]);
            $abc=Cart::instance('wishlist')->update($item->rowId,[
                'options'=> [
                    'productImage' => $image,
                    'slug'=> $sku->product->slug,
                    'sku'=> $sku->code,
                    'color'=> $sku->color->name,
                    'color_id'=> $sku->color->id,
                    'stock'=>$sku->stock
                        ]
                    ]);

            $this->updateDataBase();
            if($abc->qty > $abc->options->stock){
                $this->counts[$abc->rowId] = $abc->options->stock;
            } else {
                $this->counts[$abc->rowId] = $abc->qty;
            }
        } else {
            $this->counts[$index] = $item->qty;
        }
        }
    }
    public function render()
    {
        return view('livewire.wishlist-cart',[
            'cartitems'=>Cart::instance('wishlist')->content(),
            ]);
    }
    public function removeRow($rowId,$index){
        $this->showModal = true; $this->choose= 0;
        $cart=Cart::instance('wishlist')->get($rowId);
            $this->row['index']=$index;
            $this->row['rowId']= $cart->rowId;
            $this->row['name']= $cart->name;
            $this->row['color']= $cart->options->color;
}
    public function clearCart()
    {   $this->choose = 1;
        $this->showModal = true; 

        $this->updateDataBase();
    }
    public function updateCart($rowId,$index,$stock)
    {
    if($this->counts[$index] > $stock)
    {
    $this->counts[$index] = $stock;
    }
    Cart::instance('wishlist')->update($rowId,$this->counts[$index]);
    $this->updateDataBase();
    }
    public function decreaseCount($rowId,$index,$stock)
    {
    if (isset($this->counts[$index])) {
        $this->counts[$index]--;
        if($this->counts[$index] == 0){ $this->choose= 0;
            $this->showModal = true; $cart=Cart::instance('wishlist')->get($rowId);
            $this->row['index']=$index;
            $this->row['rowId']= $cart->rowId;
            $this->row['name']= $cart->name;
            $this->row['color']= $cart->options->color;
            $this->counts[$index] = 1;
        }
        if($this->counts[$index] > 0) {
        Cart::instance('wishlist')->update($rowId,$this->counts[$index]);
        }
        // Lógica adicional si es necesario
        $this->updateDataBase();
        $this->dispatch('wishlist-added');
    }
    }

    public function increaseCount($rowId,$index,$stock)
    {
    if (isset($this->counts[$index])) {
        if($this->counts[$index] < $stock) {
            $this->counts[$index]++;
        }

        Cart::instance('wishlist')->update($rowId,$this->counts[$index]);
        // Lógica adicional si es necesario
        $this->updateDataBase();
    }
    }
    public function updateDataBase(){
    if(auth()->user()){
        Cart::instance('wishlist')->store(auth()->user()->id);
    }
    }
    public function moveToCart($rowId,$index){
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        unset($this->counts[$index]);
        Cart::instance('cart')->add(
            $item->id,
            $item->name,
            $item->qty,
            $item->price,
            ['productImage' => $item->options->productImage,
            'slug'=> $item->options->slug,
            'sku'=> $item->options->sku,
            'color'=> $item->options->color,
            'color_id'=>$item->options->color_id,
            'stock'=> $item->options->stock
            ]
        )->associate('App\Models\Sku');
        $this->updateDataBase();
        Cart::instance('cart')->store(auth()->user()->id);
        $this->dispatch('cart-added');
        $this->dispatch('wishlist-added');
    }
    public function erase($id,$index)
    {
        Cart::instance('wishlist')->update($id,0);
        $this->updateDataBase();
        unset($this->counts[$index]);
        $this->showModal = false;
        $this->dispatch('wishlist-added');
    }
    public function ereaseall()
    {
        Cart::instance('wishlist')->destroy();
        $this->showModal = false;
        $this->dispatch('wishlist-added');
    }
}
