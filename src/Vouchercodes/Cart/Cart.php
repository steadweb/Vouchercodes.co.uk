<?php

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Product;

class Cart implements CartInterface
{
    /**
     * Array of Vouchercodes\Cart\Item instances
     *
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

        foreach($this->products as $item) {
            $total += $item->getTotal();
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
        if(!array_key_exists($product->getSku(), $this->products)) {
            $this->products[$product->getSku()] = new Item($product);
        }

        // Get the item and set the amount
        $item = $this->products[$product->getSku()];
        $item->addToQuantity($amount);
    }

    /**
     * Get the price of the product depending on how many are already in the shopping cart
     *
     * @param \Vouchercodes\Product\Product $product Product The product to determine price for
     * @return float The price of $product
     */
    public function getPriceOf(Product $product)
    {
        if(array_key_exists($product->getSku(), $this->products)) {
            $line = $this->products[$product->getSku()];
            $price = $product->getPrice();

            foreach($product->discounts() as $level => $discount) {
                if($line->getQuantity() >= $level) {
                    $price = $product->getPrice() - $discount;
                }
            }

            return $price;
        }

        return 0;
    }
}