<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $users = User::where('roles', 'STAFF')->count();
        $products = Product::count();
        $total_pemasukan = Order::sum('total_price');
        $total_pemasukan = "Rp " . number_format($total_pemasukan, 0, ',', '.');
        $order = Order::count();
        // ddd($users);
        return view('pages.dashboard', compact('users', 'products', 'total_pemasukan', 'order'));
    }
}
