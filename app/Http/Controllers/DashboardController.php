<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategories;
use Carbon\Carbon;
use PHPUnit\Framework\ExecutionOrderDependency;

class DashboardController extends Controller
{

    public function blank()
    {
        $data = [
            'page' =>'blank',
        ];
    }
    public function view(?string $state = null)
    {

        $orderStateExpected = $state ?? session()->get('orderStateExpected', 'en_attente');
        session()->put('orderStateExpected', $orderStateExpected);

        $orders = Order::where('state', $orderStateExpected);

        if( Carbon::now()->format('H:i') < '17:00'  )
        {
            $orders->whereBetween('delivery_time',[Carbon::now()->format('Y-m-d 08:00:00'),Carbon::now()->format('Y-m-d 17:00:00')] );
        }else{
            $orders->whereBetween('delivery_time',[Carbon::now()->format('Y-m-d 17:00:00'),Carbon::tomorrow()->format('Y-m-d 08:00:00')] );
        }


        $data = [
            'title' => 'Commandes',
            'orders' => $orders->get()
        ];
        return view('dashboard.order-view', $data);
    }


    public function kitchen_view(?string $state = null, ?\DateTime $date = null )
    {
        $orderStateExpected = $state ?? session()->get('orderStateExpected', 'en_attente');
        session()->put('orderStateExpected', $orderStateExpected);

        $orders = Order::where('state', $orderStateExpected);

        if($date)
        {
            $orders->where('delivery_time',$date->format('Y-m-d' ));
        }elseif( Carbon::now()->format('H:i') < '17:00'  )
        {
            $orders->whereBetween('delivery_time',[Carbon::now()->format('Y-m-d 08:00:00'),Carbon::now()->format('Y-m-d 17:00:00')] );
        }else{
            $orders->whereBetween('delivery_time',[Carbon::now()->format('Y-m-d 17:00:00'),Carbon::tomorrow()->format('Y-m-d 08:00:00')] );
        }

        $categories = ProductCategories::all();

        $data = [
            'page' => 'dashboard/kitchen-order-view',
            'title' => 'Commandes cuisine',
            'orders' => $orders->get(),
        ];
        return view('dashboard.kitchen-order-view', $data);
    }



    public function add()
    {
        $data = [
            'page' => 'dashboard/add',
            'title' => 'Ajouter une commande',
        ];
        return view('dashboard.add', $data);
    }


    public function update($id)
    {
        $data = [
            'page' => 'dashboard/update',
            'title' => 'Modifier la commande n°'.Order::find($id)->id,
            'order' => Order::find($id),
        ];

        return view('dashboard.update', $data);
    }

}
