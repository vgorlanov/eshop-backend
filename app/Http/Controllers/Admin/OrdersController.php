<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use \Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Order::with('user')->get(), 200);
    }
}
