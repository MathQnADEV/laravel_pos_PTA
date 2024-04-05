<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $nowDate = Carbon::now();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $endYear = Carbon::now()->endOfYear();
        $endDates = Carbon::now()->endOfWeek();


        $users = User::where('roles', 'STAFF')->count();
        $products = Product::count();
        $total_pemasukan = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');
        $order = Order::whereBetween('created_at', [$startDate, $endDate])->count();

        $userss = User::whereIn('roles', ['STAFF', 'ADMIN'])->get();
        $weeklyIncomeData = [];
        foreach ($userss as $user) {
            $weeklyIncomeData[$user->name] = [];
            for ($date = Carbon::now()->startOfMonth(); $date <= Carbon::now()->endOfMonth(); $date->addDay()) {
                $totalIncome = Order::whereDate('transaction_time', $date)
                    ->where('kasir_id', $user->id)
                    ->sum('total_price');
                $weeklyIncomeData[$user->name][$date->toDateString()] = $totalIncome;
            }
        }

        $today_sale = Order::whereDate('transaction_time', $nowDate)->sum('total_price');
        $week_sale = Order::whereBetween('transaction_time', [Carbon::now()->startOfWeek(), $endDates])->sum('total_price');
        $month_sale = Order::whereBetween('transaction_time', [Carbon::now()->startOfMonth(), $endDate])->sum('total_price');
        $year_sale = Order::whereBetween('transaction_time', [Carbon::now()->startOfYear(), $endYear])->sum('total_price');

        return view('pages.dashboard', compact('users', 'products', 'total_pemasukan', 'order', 'weeklyIncomeData', 'today_sale', 'week_sale', 'month_sale', 'year_sale'));
    }
}
