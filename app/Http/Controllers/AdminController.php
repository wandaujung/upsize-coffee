<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('total_price');

        $totalOrders = Order::count();

        $totalBookings = Booking::count();

        $totalProducts = Product::count();


        $salesChart = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as total')
            )
            ->groupBy('products.name')
            ->get();


        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalBookings',
            'totalProducts',
            'salesChart'
        ));
    }
}