<?php

namespace App\View\Composers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view)
    {
        $cartCount = 0;

        if (Auth::check()) {

            $cartCount = Cart::where('user_id', Auth::id())
                ->count();

        }

        $view->with('cartCount', $cartCount);
    }
}