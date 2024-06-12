<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Sku;
use Cart;
class ShoppingCart extends Component
{
    public $counts = []; public $showModal = false; public $row = []; public $choose = 0;
    public function mount()
    {
        // Inicializar la lista de counts con los valores iniciales
        $cartitems = Cart::instance('cart')->content();
        foreach ($cartitems as $index => $item) {
            $image= $item->options->productImage;
            $sku= Sku::where('code',$item->options->sku)->first();
            if(isset($sku)){
            $abc=Cart::instance('cart')->update($item->rowId,['price'=> $sku->sell_price]);
            $abc=Cart::instance('cart')->update($item->rowId,[
                'options'=> [
                    'productImage' => $image ?? 'image/dashboard/No_image_dark.png',
                    'brand'=>$sku->product->brand->name,
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
            $this->showModal = true; $this->choose= 0;
            $cart=Cart::instance('cart')->get($rowId);
                $this->row['index']=$index;
                $this->row['rowId']= $cart->rowId;
                $this->row['name']= $cart->name;
                $this->row['color']= $cart->options->color;
/*                 Cart::instance('cart')->remove($rowId);
                unset($this->counts[$index]);
                $this->dispatch('cart-added');
                $this->updateDataBase(); */
    }
    public function clearCart()
    {   $this->choose = 1;
        $this->showModal = true; 
/*         Cart::instance('cart')->destroy();
        $this->dispatch('cart-added'); */
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
            if($this->counts[$index] == 0){ $this->choose= 0;
                $this->showModal = true; $cart=Cart::instance('cart')->get($rowId);
                $this->row['index']=$index;
                $this->row['rowId']= $cart->rowId;
                $this->row['name']= $cart->name;
                $this->row['color']= $cart->options->color;
                $this->counts[$index] = 1;
            }
            if($this->counts[$index] > 0) {
            Cart::instance('cart')->update($rowId,$this->counts[$index]);
            } 
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
    public function erase($id,$index)
    {
        Cart::instance('cart')->update($id,0);
        $this->updateDataBase();
        unset($this->counts[$index]);
        $this->showModal = false;
        $this->dispatch('cart-added');
    }
    public function ereaseall()
    {
        Cart::instance('cart')->destroy();
        $this->updateDataBase();
        $this->showModal = false;
        $this->dispatch('cart-added');
    }
    public function reloadd(){
        $this->showModal = false;
    }
    public function checkout()
    {
        Session::put('can_checkout', true);
        $this->redirectRoute('checkout.index');
    }
}
