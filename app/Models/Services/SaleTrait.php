<?php


namespace App\Models\Services;

/**
 * Trait SaleTrait
 * @package App\Models\Services
 */
trait SaleTrait
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
