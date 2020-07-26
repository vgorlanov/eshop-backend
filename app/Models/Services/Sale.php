<?php


namespace App\Models\Services;

/**
 * Interface Sale
 * @package App\Models\Services
 */
interface Sale
{
    /**
     * return id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * return Price
     *
     * @return float
     */
    public function getPrice(): float;

    /**
     * return Name
     *
     * @return string
     */
    public function getName(): string;
}
