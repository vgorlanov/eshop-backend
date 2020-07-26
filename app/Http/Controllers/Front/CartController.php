<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Library\Cart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private Cart $cart;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->cart = Auth::user()->cart();
            return $next($request);
        });
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->cart->all(), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $product = Product::find($request->id);

        $this->cart->add($product);

        return response()->json($this->cart->all(), 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->cart->remove($id);

        return response()->json($this->cart->all(),200);
    }

}
