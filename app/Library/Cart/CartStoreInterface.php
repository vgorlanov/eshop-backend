<?php


namespace App\Library\Cart;


use App\Models\Services\Sale;

interface CartStoreInterface
{
    /**
     * add product to cart
     *
     * @param Sale $model
     */
    public function add(Sale $model): void;

    /**
     * remove product from cart
     *
     * @param int $id
     */
    public function remove(int $id): void;

    /**
     * get all products
     *
     * @return array
     */
    public function all(): array;

    /**
     * clear cart
     */
    public function flush(): void;

    /**
     * set key for storage
     *
     * @param string $key
     */
    public function setKey(string $key): void;
}
