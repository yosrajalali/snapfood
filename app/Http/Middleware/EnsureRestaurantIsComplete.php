<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRestaurantIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */

    public function handle(Request $request, Closure $next, $checkType = null)
    {
        $seller = Auth::user();

        if ($checkType === 'create') {
            if ($seller->restaurant && $seller->restaurant->is_complete) {
                return redirect()->route('seller.recentOrders')->with('error', 'شما قبلاً یک رستوران ثبت کرده‌اید.');
            }
        } else {
            if (!$seller->restaurant || !$seller->restaurant->is_complete) {
                return redirect()->route('seller.restaurants.create')->with('error', 'لطفا ابتدا اطلاعات رستوران خود را تکمیل کنید.');
            }
        }

        return $next($request);
    }
}
