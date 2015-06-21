<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Discount\Discount;

class DiscountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Discount
     */
    private $discount;

    public function setUp()
    {
        $this->discount = new Discount(10, 5, Discount::MORE_THAN_EQUAL_TO);
    }

    public function testDiscount()
    {
        $this->assertEquals(10, $this->discount->getThreshold());
        $this->assertEquals(5, $this->discount->getAmount());
        $this->assertEquals(0, $this->discount->calculate(9));
        $this->assertEquals(5, $this->discount->calculate(10));
        $this->assertEquals(5, $this->discount->calculate(100));
    }

    public function testMoreThan()
    {
        $discount = new Discount(100, 20);

        $values = [
            100 => 0,
            101 => 20,
            2000 => 20,
            0 => 0,
            'asdasd' => 0,
            false => 0
        ];

        foreach($values as $quantity => $expected) {
            $this->assertEquals($expected, $discount->calculate($quantity));
        }
    }

    public function testInvalidOperator()
    {
        $discount = new Discount(100, 20, '=');

        $this->assertEquals(0, $discount->calculate(100));
    }
}