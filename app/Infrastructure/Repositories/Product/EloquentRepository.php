<?php


namespace App\Infrastructure\Repositories\Product;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Request;

class EloquentRepository implements ProductRepository
{
    /**
     * @inheritDoc
     */
    public function byId(int $id): Product
    {
        return Product::find($id);
    }

    /**
     * @inheritDoc
     */
    public function paginate(Request $request): AbstractPaginator
    {
        $order = $request->get('order');
        $search = $request->get('search');

        if($request->has('category')) {
            return Product::where('name', 'like', "%$search%")
                ->where('category_id', '=', $request->get('category'))
                ->orderBy(key($order), current($order))
                ->paginate($request->get('per'));
        }

        return Product::where('name', 'like', "%$search%")
            ->orderBy(key($order), current($order))
            ->paginate($request->get('per'));
    }

}
