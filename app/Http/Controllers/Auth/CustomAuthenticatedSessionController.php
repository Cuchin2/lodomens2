<?php

namespace App\Http\Controllers\Auth;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Gloudemans\Shoppingcart\Facades\Cart; // Asegúrate de importar la clase Cart
use Illuminate\Http\Request;

class CustomAuthenticatedSessionController extends AuthenticatedSessionController
{
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            // Código personalizado para cargar el carrito de compras
            $carold = Cart::instance('cart')->content();
            foreach ($carold as $key => $row) {
                $items[$key] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'qty' => $row->qty,
                    'price' => $row->price,
                    'options' => [
                        'productImage' => $row->options->productImage,
                        'brand' => $row->options->brand,
                        'slug' => $row->options->slug,
                        'sku' => $row->options->sku,
                        'color' => $row->options->color,
                        'color_id' => $row->options->color_id,
                        'stock' => $row->options->stock,
                        'hex' => $row->options->hex,
                        'src' => $row->options->src,
                    ]
                ];
            }

            Cart::instance('cart')->destroy();
            Cart::instance('cart')->restore(auth()->user()->id);

            if (isset($items)) {
                foreach ($items as $item) {
                    Cart::instance('cart')->add(
                        $item['id'],
                        $item['name'],
                        $item['qty'],
                        $item['price'],
                        $item['options']
                    )->associate('App\Models\Sku');
                }
                Cart::instance('cart')->store(auth()->user()->id);
            }

            Cart::instance('wishlist')->restore(auth()->user()->id);

            return redirect('/');
        });
    }
}
