<?php
use App\Models\Sku;
use Gloudemans\Shoppingcart\Facades\Cart;

function checkStock()
{
    // Obtener los elementos del carrito
    $items = Cart::instance('cart')->content();
    $skus = [];
    $out = [];

    // Iterar sobre los items del carrito
    foreach ($items as $key => $item) {
        // Obtener el SKU desde el item
        $skuCode = $item->options->sku;

        // Buscar el SKU en la base de datos
        $sku = Sku::where('code', $skuCode)->first();

        // Si el SKU no existe en la base de datos, remover del carrito
        if (!$sku) {
            $out[] = $item;
            Cart::instance('cart')->remove($item->rowId);
            continue; // Saltar al siguiente item en el carrito
        }

        // Si el stock es menor que la cantidad en el carrito
        if ($sku->stock < $item->qty) {
            // Guardar el item en el array antes de actualizar el carrito
            if ($sku->stock > 0) {
                $skus[] = $item;
                // Si hay stock disponible, ajustamos la cantidad
                Cart::instance('cart')->update($item->rowId, $sku->stock);
            } else {
                $out[] = $item;
                // Si el stock es cero, eliminamos el item del carrito
                Cart::instance('cart')->remove($item->rowId);
            }
        }
    }

    return [
        'skus' => $skus,  // Items con problemas de stock
        'out' => $out     // Items que fueron actualizados o eliminados
    ];
}
