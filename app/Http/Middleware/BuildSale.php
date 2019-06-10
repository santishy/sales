<?php

namespace App\Http\Middleware;
use App\Sale;
use Closure;

class BuildSale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //dd(\Session::get('sale_id'));
      $request->sale = Sale::findOrCreateSale(\Session::get('sale_id'));
      //dd($request->sale);
      return $next($request);
    }
}
