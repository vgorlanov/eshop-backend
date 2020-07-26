<?php

namespace Tests\Unit\Repository;

use App\Infrastructure\Repositories\NotFoundException;
use App\Infrastructure\Repositories\Product\MemoryRepository;
use App\Infrastructure\Repositories\Product\ProductRepository;
use App\Models\Product;
use Tests\TestCase;

class MemoryTest extends TestCase
{
    private ProductRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $models = factory(Product::class, 20)->make();
        $products = [];
        $i = 1;

        foreach ($models as $model) {
            $model->id = $i;
            $products[$i] = $model->toArray();
            $i++;
        }
        $this->repository = new MemoryRepository($products);
    }

    public function testGetById_success(): void
    {
        $id = 1;
        $product = $this->repository->byId($id);

        $this->assertSame($product->getId(), $id);

        $this->assertInstanceOf(Product::class, $product);
    }
    public function testGetById_NotFoundException(): void
    {
        $this->expectException(NotFoundException::class);
        $this->repository->byId(999);
    }

}
