<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    /**
     * @param Request $request

     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('category');

        if($request->has('search')) {
            $query->where('name', 'like', '%'.$request->get('search').'%');
        }

        if($request->has('category')) {
            $query->where('category_id', $request->get('category'));
        }

        if($request->has('order')) {
            $order = explode('_', $request->get('order'));

            $query->orderBy(current($order), last($order));
        }

        $result = $query->paginate((int) $request->get('per'));

        return response()->json($result, 200);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product, 200);
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        return response()->json((new Product($request->all()))->save(), 200);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        return response()->json($product->update($request->input()), 200);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Product $product): JsonResponse
    {
        return response()->json($product->delete());
    }
}
