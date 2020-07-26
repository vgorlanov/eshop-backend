<?php


namespace App\Library\Cart;

use App\Models\Services\Sale;

class ArrayCartStore implements CartStoreInterface
{
    private array $store = [];

    private string $key;


    /**
     * @inheritDoc
     */
    public function add(Sale $model): void
    {
        $this->store[$model->getId()] = $model;
    }

    /**
     * @inheritDoc
     */
    public function remove(int $id): void
    {
        unset($this->store[$id]);
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->store;
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->store = [];
    }

    /**
     * set id for storage
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}
