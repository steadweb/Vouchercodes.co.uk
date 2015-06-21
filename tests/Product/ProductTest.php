<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Tomato;
use Vouchercodes\Product\Lemon;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Lemon
     */
    private $lemon;

    /**
     * @var Tomato
     */
    private $tomato;

    public function setUp()
    {
        $this->lemon = new Lemon();
        $this->tomato = new Tomato();
    }

    public function testPrice()
    {
        $this->assertEquals(0.50, $this->lemon->getPrice());
        $this->assertEquals(0.20, $this->tomato->getPrice());
    }

    public function testSku()
    {
        $this->assertEquals('Lemon', $this->lemon->getSku());
        $this->assertEquals('Tomato', $this->tomato->getSku());
    }

    public function testDiscounts()
    {
        $this->assertCount(1, $this->lemon->discounts());
        $this->assertCount(3, $this->tomato->discounts());

        $this->assertInternalType('array', $this->lemon->discounts());
        $this->assertInternalType('array', $this->tomato->discounts());
    }
}