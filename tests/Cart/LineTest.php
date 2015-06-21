<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Tomato;
use Vouchercodes\Product\Lemon;

class LineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Item
     */
    private $tomato;

    /**
     * @var Item
     */
    private $lemon;

    public function setUp()
    {
        $this->tomato = new Item(new Tomato(), 101);
        $this->lemon = new Item(new Lemon(), 25);
    }

    public function testItems()
    {
        $this->assertInstanceOf('Vouchercodes\Cart\Item', $this->tomato);
        $this->assertInstanceOf('Vouchercodes\Cart\Item', $this->lemon);
    }

    public function testProduct()
    {
        $this->assertInstanceOf('vouchercodes\Product\Tomato', $this->tomato->product());
        $this->assertInstanceOf('vouchercodes\Product\Lemon', $this->lemon->product());
    }

    public function testQuantites()
    {
        $this->assertEquals(101, $this->tomato->getQuantity());
        $this->assertEquals(25, $this->lemon->getQuantity());
    }

    public function testAddQuantity()
    {
        $this->lemon->addToQuantity(50);
        $this->assertEquals(75, $this->lemon->getQuantity());

        $this->tomato->addToQuantity(100);
        $this->assertEquals(201, $this->tomato->getQuantity());
    }

    public function testSetQuantity()
    {
        $lemonQuantites = [
            1,
            100,
            'asd',
            1234,
            false,
            array(),
            '-',
            '$%^&*',
            25
        ];

        $lastIntValue = 100;

        foreach($lemonQuantites as $quantity) {
            $this->lemon->setQuantity($quantity);

            if(is_int($quantity)) {
                $lastIntValue = $quantity;
            }

            $this->assertEquals($lastIntValue, $this->lemon->getQuantity());
        }
    }

    public function testTotal()
    {
        $this->assertEquals(11.75, $this->lemon->getTotal());
        $this->assertEquals(18.54, $this->tomato->getTotal());

        $this->lemon->setQuantity(15);
        $this->assertEquals(7.25, $this->lemon->getTotal());
    }

}