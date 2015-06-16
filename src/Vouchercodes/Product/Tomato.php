<?php

namespace Vouchercodes\Product;

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
            '20' => 0.02,
            '100' => 0.04,
            '101' => 0.06,
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