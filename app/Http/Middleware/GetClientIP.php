<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;
class GetClientIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientIP = $request->ip();
        if ($clientIP ==  '192.168.3.34')
        { $clientIP = '179.6.2.241';  } //179.6.2.241
        $location = Location::get($clientIP);

        if ($location && $location->countryCode === 'PE') {
            $currency=  'S/.';
        } else {
            $currency= '$ ';
        }
        session(['currency' => $currency]);
        session(['location' => $location->countryCode ]);

        return $next($request);
    }
}
