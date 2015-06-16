<?php

/**
* Interface CartInterface
*
* @package ShoppingCart
*/

namespace Vouchercodes\Cart;

use Vouchercodes\Product\Product;

interface CartInterface {

	/**
	* Display a summary of the shopping cart
	* @return string
	*/
	public function getTotalSum();

    /**
     * Add an item to the shopping cart
     *
     * @param \Vouchercodes\Product\Product $product Instance of the Product we're adding
     * @param int $amount The amount of $product
     *
     * @return void
     */
	public function addItem(Product $product, $amount);

    /**
     * Get the price of the product depending on how many are already in the shopping cart
     *
     * @param \Vouchercodes\Product\Product $product Product The product to determine price for
     * @return float The price of $product
     */
	public function getPriceOf(Product $product);
}