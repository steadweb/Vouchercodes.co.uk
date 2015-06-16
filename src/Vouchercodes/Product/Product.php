<?php

namespace Vouchercodes\Product;

abstract class Product implements \Vouchercodes\Product\ProductInterface
{
    /**
     * @var int
     */
    public $quantity = 0;

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

    /**
     * @return int
     */
    public function getTotal()
    {
        $total = 0;

        $quantity = $this->quantity;
        $price = $this->getPrice();

        foreach($this->discounts() as $discount => $deduct) {

            if($quantity >= $discount) {
                $total += $price * (int) $discount;
                $quantity -= $discount;
                $price -= $deduct;
            }
        }

        $total += $price * (int) $quantity;

        return $total;
    }
}