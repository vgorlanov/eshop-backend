<?php

namespace Tests\Unit\Library;

use App\Library\Cart\ArrayCartStore;
use App\Library\Cart\Cart;
use App\Models\Product;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * @var Cart
     */
    private Cart $cart;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->cart = new Cart('key', new ArrayCartStore());
    }

    public function testAdd_success(): void
    {
        $product = $this->makeProduct();
        $this->cart->add($product);
        $this->assertArrayHasKey($product->getId(), $this->cart->all());
    }

    public function testAll_success(): void
    {
        $this->cart->add($this->makeProduct());
        $this->cart->add($this->makeProduct());

        $this->assertCount(2, $this->cart->all());
    }

    public function testRemove_success(): void
    {
        $this->cart->add($p1 = $this->makeProduct());
        $this->cart->add($p2 = $this->makeProduct());

        $this->assertCount(2, $this->cart->all());

        $this->cart->remove($p1->getId());

        $this->assertCount(1, $values = $this->cart->all());
        $this->assertSame(current($values)->id, $p2->getId());
    }

    public function testFlush_success(): void
    {
        $this->cart->add($this->makeProduct());
        $this->cart->add($this->makeProduct());

        $this->assertCount(2, $this->cart->all());

        $this->cart->flush();
        $this->assertCount(0, $this->cart->all());
    }

    /**
     * product factory
     *
     * @return Product
     */
    private function makeProduct(): Product
    {
        $product = factory(Product::class)->make();
        $product->id = mt_rand();
        return $product;
    }
}
