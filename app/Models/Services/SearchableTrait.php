<?php


namespace App\Models\Services;


use ReflectionClass;

/**
 * Trait SearchableTrait
 * @package App\Models\Services
 */
trait SearchableTrait
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    public function getData(): array
    {
        return $this->toArray();
    }
}
