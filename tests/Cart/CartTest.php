<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Lemon;
use Vouchercodes\Product\Tomato;

class CartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var Lemon
     */
    private $lemon;

    /**
     * @var
     */
    private $tomato;

    public function setUp()
    {
        $this->cart = new Cart();
        $this->lemon = new Lemon();
        $this->tomato = new Tomato();
    }

    public function testCart()
    {
        $this->assertInstanceOf('Vouchercodes\Cart\Cart', $this->cart);
    }

    public function testAddItem()
    {
        $this->cart->addItem($this->lemon, 10);
        $this->cart->addItem($this->lemon, 15);

        $this->assertEquals(11.75, $this->cart->getTotalSum());

        $this->cart->addItem($this->tomato, 20);
        $this->cart->addItem($this->tomato, 80);
        $this->cart->addItem($this->tomato, 1);

        $this->assertEquals(30.29, $this->cart->getTotalSum());
    }

    public function testGetPriceOfLemon()
    {
        $this->cart->addItem($this->lemon, 10);

        $this->assertEquals(0.50, $this->cart->getPriceOf($this->lemon));

        $this->cart->addItem($this->lemon, 1);

        $this->assertEquals(0.45, $this->cart->getPriceOf($this->lemon));
    }

    public function testGetPriceOfTomato()
    {
        $this->cart->addItem($this->tomato, 20);

        $this->assertEquals(0.20, $this->cart->getPriceOf($this->tomato));

        $this->cart->addItem($this->tomato, 80);

        $this->assertEquals(0.18, $this->cart->getPriceOf($this->tomato));

        $this->cart->addItem($this->tomato, 1);

        $this->assertEquals(0.14, $this->cart->getPriceOf($this->tomato));
    }

    public function testGetPriceOfEmptyCart()
    {
        $cart = new Cart();

        $this->assertEquals(0, $cart->getPriceOf($this->lemon));
    }
}