<?php

namespace Vouchercodes\Product;

use Vouchercodes\Discount\Discount;

class Lemon extends Product
{
    /**
     * A public function to get the SKU (a unique code to identify the product)
     *
     * @return mixed
     */
    public function getSku()
    {
        return 'Lemon';
    }

    /**
     * A method to determine the rules for each product
     *
     * @return mixed
     */
    public function discounts()
    {
        return [
            new Discount(10, 0.05),
        ];
    }

    /**
     * Get the base price of the product
     *
     * @return float
     */
    public function getPrice()
    {
        return 0.5;
    }

} 