<?php


namespace App\Models\Services;

/**
 * Trait ImageTrait
 * @package App\Models\Services
 */
trait ImageTrait
{
    /**
     * @param $value
     * @return string
     * @throws \JsonException
     */
    public function getImagesAttribute($value): string
    {
        return $value ? json_decode($value, true, 512, JSON_THROW_ON_ERROR) : '';
    }

    /**
     * @param $value
     * @throws \JsonException
     */
    public function setImagesAttribute($value): void
    {
        $this->attributes['images'] = json_encode($value, JSON_THROW_ON_ERROR);
    }
}
