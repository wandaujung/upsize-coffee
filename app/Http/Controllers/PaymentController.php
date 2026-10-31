<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        abort_unless(
            (int) $order->user_id === (int) Auth::id(),
            403
        );

        return view('pages.payment.index', compact('order'));
    }
}
