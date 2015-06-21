<?php

namespace Vouchercodes\Product;

abstract class Product implements \Vouchercodes\Product\ProductInterface
{
    /**
     * A public function to get the SKU (a unique code to identify the product)
     *
     * @return mixed
     */
    abstract public function getSku();

    /**
     * A method to determine the rules for each product
     *
     * @return mixed
     */
    abstract public function discounts();

    /**
     * Get the base price of the product
     *
     * @return float
     */
    abstract public function getPrice();
}