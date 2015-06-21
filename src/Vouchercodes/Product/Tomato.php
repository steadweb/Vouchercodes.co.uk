<?php

namespace Vouchercodes\Product;

use Vouchercodes\Discount\Discount;

class Tomato extends Product
{
    /**
     * A public function to get the SKU (a unique code to identify the product)
     *
     * @return mixed
     */
    public function getSku()
    {
        return 'Tomato';
    }

    /**
     * A method to determine the rules for each product
     *
     * @return mixed
     */
    public function discounts()
    {
        return [
            new Discount(101, 0.06, Discount::MORE_THAN_EQUAL_TO),
            new Discount(100, 0.04),
            new Discount(20, 0.02)
        ];
    }

    /**
     * Get the base price of the product
     *
     * @return float
     */
    public function getPrice()
    {
        return 0.2;
    }
} 