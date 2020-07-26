<?php


namespace App\Library\Search;


use App\Models\Services\Searchable;

interface SearchInterface
{
    /**
     * @param string $string
     * @param int $page
     * @return array
     */
    public function search(string $string = null, int $page = 1): array;

    /**
     * get one document
     *
     * @param int $id
     * @return array
     */
    public function find(int $id): array;

    /**
     * check index exists
     *
     * @param int $id
     * @return bool
     */
    public function has(int $id): bool;

    /**
     * create document
     *
     * @param Searchable $model
     * @return array
     */
    public function index(Searchable $model): array;

    /**
     * update document
     *
     * @param Searchable $model
     * @return array
     */
    public function update(Searchable $model): array;

    /**
     * delete document from index
     *
     * @param Searchable $model
     * @return void$search
     */
    public function delete(Searchable $model): void;

    /**
     * clear all cache
     *
     * @return void
     */
    public function flush(): void;

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields): self;

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit): self;

    /**
     * @param $types
     * @return $this
     */
    public function setTypes($types): self;

    /**
     * @param array $order
     * @return $this
     */
    public function setOrder(array $order): self;

    /**
     * @param array $must
     * @return $this
     */
    public function setMust(array $must): self;
}
