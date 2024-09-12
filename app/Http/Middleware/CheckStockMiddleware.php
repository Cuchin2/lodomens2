<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            // Excluir una ruta específica por nombre o URI
            if ($request->routeIs('web.shop.checkout.pay')) {
                return $next($request);
            }
            if (!session('reserve')) {
                $result = checkStock(true);
                $outstock = $result['skus'];
                $zerostock = $result['out'];
            }
            else{
                session()->forget('reserve');
            }


         view()->share(['outstock' => $outstock ?? '', 'zerostock' => $zerostock ?? '']);
        return $next($request);
    }
}
