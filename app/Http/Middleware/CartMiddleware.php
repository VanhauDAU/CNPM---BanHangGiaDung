<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\admin\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $total = 0;
        if (Auth::check()) {
            $cart = ShoppingCart::where('user_id', Auth::id())->get();
            $total = $cart->sum(function($item) {
                return $item->price * $item->qty;
            });
        } else {
            $cart = Cart::content();
            $total = Cart::total();
        }
        View::share('cart', $cart);
        View::share('cartTotal', $total);

        return $next($request);
    }
}
