<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Product;

class Cart implements CartInterface
{
    /**
     * @var array
     */
    var $products = [];

    /**
     * Display a summary of the shopping cart
     * @return string
     */
    public function getTotalSum()
    {
        $total = 0;

        foreach($this->products as $product) {
            $total += $product->getTotal();
        }

        return $total;
    }

    /**
     * Add an item to the shopping cart
     *
     * @param \Vouchercodes\Product\Product $product Instance of the Product we're adding
     * @param int $amount The amount of $product
     *
     * @return void
     */
    public function addItem(Product $product, $amount)
    {
        $product->quantity += $amount;
        $this->products[$product->getSku()] = $product;
    }

    /**
     * Get the price of the product depending on how many are already in the shopping cart
     *
     * @param \Vouchercodes\Product\Product $product Product The product to determine price for
     * @return float The price of $product
     */
    public function getPriceOf(Product $product)
    {
        $price = $product->getPrice();

        foreach($product->discounts() as $level => $discount) {
            if($product->quantity >= $level) {
                $price = $product->getPrice() - $discount;
            }
        }

        return $price;
    }
}