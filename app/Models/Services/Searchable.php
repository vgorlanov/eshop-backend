<?php


namespace App\Models\Services;

/**
 * Interface Searchable
 * @package App\Models\Services
 */
interface Searchable
{
    /**
     * return id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * get entity type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * data for indexer
     *
     * @return array
     */
    public function getData(): array;

}
