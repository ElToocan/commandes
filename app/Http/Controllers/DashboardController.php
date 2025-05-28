<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PHPUnit\Framework\ExecutionOrderDependency;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'test',
            'title' => 'Dashboard',
            'orders' => Order::all(),
        ];
        return view('blank', $data);
    }
}
