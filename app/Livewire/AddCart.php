<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Color;
use Cart;
use Livewire\Attributes\On;
class AddCart extends Component
{
    public $sku; public $limit; public $message; public $product_name;
    public $product; public $showCreateModal = false;
    public $color; public $modalMessage = false;

    public function render()
    {
        return view('livewire.add-cart');
    }
    public function add($qtn,$color)
    {
        $product = Product::with(['images','type'])->find($this->product); $productId=$product->id;
        $sku = Sku::where(['product_id'=>$product->id, 'color_id' =>$color])->first();
            // Obtén el ítem del carrito si ya existe
            $cartItem = Cart::instance('cart')->content()->where('id', $productId)->first();
            $currentQtyInCart = $cartItem ? $cartItem->qty : 0;
            $requestedQuantity = $qtn;
            // Consulta el stock disponible desde la base de datos
            $stockAvailable = $sku->stock; // Aquí consultas el stock real del SKU
            if ($cartItem) {
                // Si el producto ya está en el carrito, calcula la nueva cantidad
                $newQty = $cartItem->qty + $requestedQuantity;

                // Verifica si la nueva cantidad excede el stock disponible
                if ($newQty <= $stockAvailable) {
                    // Actualiza la cantidad del producto en el carrito
                    Cart::instance('cart')->update($cartItem->rowId, $newQty);

/*                     return response()->json([
                        'message' => 'Cantidad actualizada correctamente',
                        'cartItem' => $cartItem,
                    ]); */
                } else {
                // Calcula cuántos productos puedes agregar sin exceder el stock
                $availableToAdd = $stockAvailable - $currentQtyInCart;
                Cart::instance('cart')->update($cartItem->rowId, $availableToAdd+$cartItem->qty);
                    /* return response()->json(['message' => 'No hay suficiente stock disponible']); */
                }
            } else {
                // Si el producto no está en el carrito, agrégalo si la cantidad solicitada es menor o igual al stock disponible
                if ($requestedQuantity <= $stockAvailable) {
                    Cart::instance('cart')->add(
                        $product['id'],
                        $product['name'],
                        $requestedQuantity,
                        $sku->sell_price,
                        ['productImage' => $product->images->where('color_id',$color)->first()->url ?? 'image/dashboard/No_image_dark.png',
                        'brand'=>$product->brand->name,
                        'slug'=> $product->slug,
                        'sku'=>$sku->code,
                        'color'=>$sku->color->name,
                        'color_id'=>$sku->color_id,
                        'stock'=>$sku->stock,
                        'hex'=> $product->type->hex,
                        'src'=> $product->type->images->url ?? '',
                        ]
                    )->associate('App\Models\Sku');
                         $this->message='Producto agregado correctamente';
/*                     return response()->json([
                        'message' => 'Producto agregado correctamente',
                        'cartItem' => $newCartItem,
                    ]); */
                } else {
                    $this->message='No hay suficiente stock disponible';
                    /* return response()->json(['message' => 'No hay suficiente stock disponible']); */
                }
            }

        $this->dispatch('cart-added');
        $this->redirectRoute('web.shop.cart.index');
    }
    #[On('add-wishlist')]
    public function addwish($color)
    {
        if(auth()->user()){
            $product = Product::with(['images','type'])->find($this->product); $productId=$product->id;
            $sku = Sku::where(['product_id'=>$product->id, 'color_id' =>$color])->first();
            $cartItem = Cart::instance('wishlist')->content()->where('id', $productId)->first();
            if($cartItem){
                Cart::instance('wishlist')->update($cartItem->rowId,$cartItem->qty+1);
            } else {
                Cart::instance('wishlist')->add(
                    $product->id,
                    $product->name,
                    1,
                    $sku->sell_price,
                    ['productImage' => $product->images->where('color_id',$color)->first()->url ?? 'image/dashboard/No_image_dark.png',
                    'brand'=>$product->brand->name,
                    'slug'=> $product->slug,
                    'sku'=>$sku->code,
                    'color'=>$sku->color->name,
                    'color_id'=>$sku->color_id,
                    'stock'=>$sku->stock,
                    'hex'=> $product->type->hex,
                    'src'=> $product->type->images->url ?? '',
                    ]
                )->associate('App\Models\Sku');
            }

            Cart::instance('wishlist')->store(auth()->user()->id);
            $this->dispatch('wishlist-added');
        }
        else{
            $this->showCreateModal= true;
        }
        $this->modalMessage = true;
    }

}
