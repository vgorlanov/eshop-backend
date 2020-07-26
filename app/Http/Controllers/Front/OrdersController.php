<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use \Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(auth()->user()->orders, 200);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $user = auth()->user();
        $cart = $user->cart();

        $order = new Order([
            'user_id'  => $user->id,
            'price'    => $cart->price(),
            'products' => $cart->all(),
        ]);
        $order->save();
        $cart->flush();

        return response()->json(1, 200);
    }
}
