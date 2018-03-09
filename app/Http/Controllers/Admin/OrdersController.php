<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
        {
            $orders = Order::all();

            $params = [
                'title' => 'Orders Listing',
                'orders' => $orders,
            ];

            return view('admin.orders.list')->with($params);
        }
    }
