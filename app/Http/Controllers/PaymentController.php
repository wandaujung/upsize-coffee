<?php

namespace App\Http\Controllers;

use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        return view('pages.payment.index', compact('order'));
    }
}