<?php


namespace App\Infrastructure\Repositories\Product;


use App\Infrastructure\Repositories\NotFoundException;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

class MemoryRepository implements ProductRepository
{
    private array $models;

    public function __construct(array $models)
    {
        $this->models = $models;
    }

    public function byId(int $id): Product
    {
        if(!isset($this->models[$id])) {
            throw new NotFoundException('Product not found');
        }

        return new Product($this->models[$id]);
    }

    public function paginate(Request $request): AbstractPaginator
    {
        // TODO: Implement paginate() method.
    }
}
