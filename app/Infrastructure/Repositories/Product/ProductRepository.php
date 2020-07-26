<?php


namespace App\Infrastructure\Repositories\Product;


use App\Infrastructure\Repositories\NotFoundException;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

interface ProductRepository
{
    /**
     * get model by id
     *
     * @param int $id
     * @return Product
     * @throws NotFoundException
     */
    public function byId(int $id): Product;

    /**
     * @param Request $request
     * @return AbstractPaginator
     */
    public function paginate(Request $request): AbstractPaginator;
}
