<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use Cart;
class StockController extends Controller
{
    public function restock(Request $request){
        $items = Cart::instance('temp_reservation')->content();

        // Iterar sobre los items del carrito
        foreach ($items as $item) {
            // Obtener el sku desde el item
            $skuCode = $item->options->sku;

            // Buscar el SKU en la base de datos
            $sku = Sku::where('code', $skuCode)->first();

            // Restar la cantidad de la columna 'stock'
            $sku->stock += $item->qty;

            // Guardar los cambios
            $sku->save();
        }
    }
}
