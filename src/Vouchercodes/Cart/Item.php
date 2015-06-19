<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Product;

class Item
{
    /**
     * @var int
     */
    private $quantity = 0;

    /**
     * @var Product
     */
    private $product;

    /**
     * Glue the product, quantity and cart together.
     *
     * @param Product $product
     * @param null $quantity
     * @throws ProductNotFoundException
     */
    public function __construct(Product $product, $quantity = null)
    {
        if(is_null($product)) {
            throw new ProductNotFoundException('Product not found');
        }

        $this->product = $product;
        $this->setQuantity($quantity);
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        $total = 0;

        $quantity = $this->quantity;
        $price = $this->product->getPrice();

        foreach($this->product->discounts() as $discount => $deduct) {

            if($quantity >= $discount) {
                $total += $price * (int) $discount;
                $quantity -= $discount;
                $price -= $deduct;
            }
        }

        $total += $price * (int) $quantity;

        return $total;
    }

    /**
     * Return the product instance
     *
     * @return Product
     */
    public function product()
    {
        return $this->product;
    }

    /**
     * Return the quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return (int) $this->quantity;
    }

    /**
     * Update the amount of the quantity
     *
     * @param int $quantity
     */
    public function addToQuantity($quantity)
    {
        if(is_int($quantity)) {
            $this->quantity += $quantity;
        }
    }

    /**
     * Set the quantity of the item
     *
     * @param $quantity
     */
    public function setQuantity($quantity)
    {
        if(is_int($quantity)) {
            $this->quantity = $quantity;
        }
    }
}

/**
 * Class ProductNotFoundException
 * @package Vouchercodes\Cart
 */
class ProductNotFoundException extends \Exception {}