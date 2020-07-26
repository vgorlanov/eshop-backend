<?php

namespace App\Observers;

use App\Library\Search\SearchInterface;
use App\Models\Product;

/**
 * Class ProductObserver
 * @package App\Observers
 */
class ProductObserver
{
    /**
     * @var SearchInterface
     */
    private SearchInterface $search;

    /**
     * ProductObserver constructor.
     * @param SearchInterface $search]
     */
    public function __construct(SearchInterface $search)
    {
        $this->search = $search;
    }

    /**
     * Handle the product "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product): void
    {
        $this->search->index($product);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param Product $product
     * @return void
     */
    public function updated(Product $product): void
    {
        $this->search->update($product);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function deleted(Product $product): void
    {
        $this->search->delete($product);
    }

    /**
     * Handle the product "restored" event.
     *
     * @param Product $product
     * @return void
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
