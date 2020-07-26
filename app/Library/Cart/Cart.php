<?php

namespace App\Library\Cart;

use App\Models\Services\Sale;

/**
 * Class Cart
 * @package App\Library\Cart
 */
class Cart
{
    /**
     * @var CartStoreInterface
     */
    private CartStoreInterface $store;


    /**
     * Cart constructor.
     * @param string $key
     * @param CartStoreInterface $store
     */
    public function __construct(string $key, CartStoreInterface $store)
    {
        $this->store = $store;
        $this->store->setKey($key);
    }

    /**
     * add to cart
     *
     * @param Sale $model
     */
    public function add(Sale $model): void
    {
        $this->store->add($model);
    }

    /**
     * return all
     *
     * @return array
     */
    public function all(): array
    {
        return $this->store->all();
    }

    /**
     * delete product from cart
     *
     * @param int $id
     */
    public function remove(int $id): void
    {
        $this->store->remove($id);
    }

    /**
     * cart`s price
     *
     * @return float
     */
    public function price(): float
    {
        $values = $this->store->all();
        $price = 0;

        foreach ($values as $value) {
            $price += $value['data']['price'] * $value['count'];
        }

        return $price;
    }

    /**
     * clear cart
     */
    public function flush(): void
    {
        $this->store->flush();
    }

}
