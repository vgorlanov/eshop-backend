<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Infrastructure\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    /**
     * count rows on page
     *
     * @var int
     */
    private int $per = 16;

    /**
     * default sort
     *
     * @var array
     */
    private array $order = ['created_at' => 'desc'];

    /**
     * product's repository
     *
     * @var ProductRepository
     */
    private ProductRepository $product;

    /**
     * ProductsController constructor.
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $values = $request->all();
        $order = isset($values['order']) ? explode('_', $request->get('order')) : null;

        $must = [];
        if (isset($values['category'])) {
            $must = ['category_id' => $values['category']];
        }

        $request->merge([
            'per'    => $values['per'] ?? $this->per,
            'order'  => $order ? [$order[0] => $order[1]] : $this->order,
            'search' => $values['search'] ?? null,
            'page'   => $values['page'] ?? 1,
            'must'   => $must,
        ]);

        return response()->json($this->product->paginate($request), 200);
    }

    /**
     * show one product
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->product->byId($id);

        if ($product) {
            return response()->json($product, 200);
        }

        return response()->json(404);
    }

}
