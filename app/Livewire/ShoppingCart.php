<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sku;
use Cart;
class ShoppingCart extends Component
{
    public $counts = [];
    public function mount()
    {
        // Inicializar la lista de counts con los valores iniciales
        $cartitems = Cart::instance('cart')->content();
        foreach ($cartitems as $index => $item) {
            $image= $item->options->productImage;
            $sku= Sku::where('code',$item->options->sku)->first();
            if(isset($sku)){
            $abc=Cart::update($item->rowId,['price'=> $sku->sell_price]);
            $abc=Cart::update($item->rowId,[
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
        return view('livewire.shopping-cart',[
            'cartitems'=>Cart::instance('cart')->content(),
            ]);
    }
    public function removeRow($rowId,$index){
                Cart::instance('cart')->remove($rowId);
                unset($this->counts[$index]);
                $this->dispatch('cart-added');
                $this->updateDataBase();
    }
    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('cart-added');
        $this->updateDataBase();
    }
    public function updateCart($rowId,$index,$stock)
    {
    if($this->counts[$index] > $stock)
    {
        $this->counts[$index] = $stock;
    }
        Cart::instance('cart')->update($rowId,$this->counts[$index]);
        $this->updateDataBase();
    }
    public function decreaseCount($rowId,$index,$stock)
    {
        if (isset($this->counts[$index])) {
            $this->counts[$index]--;
            Cart::instance('cart')->update($rowId,$this->counts[$index]);
            // Lógica adicional si es necesario
            $this->updateDataBase();
        }
    }

    public function increaseCount($rowId,$index,$stock)
    {
        if (isset($this->counts[$index])) {
            if($this->counts[$index] < $stock) {
                $this->counts[$index]++;
            }

            Cart::instance('cart')->update($rowId,$this->counts[$index]);
            // Lógica adicional si es necesario
            $this->updateDataBase();
        }
    }
    public function updateDataBase(){
        if(auth()->user()){
            Cart::instance('cart')->store(auth()->user()->id);}
    }
}
