<?php

require_once('vendor/autoload.php');

// Cart
$cart = new \Vouchercodes\Cart\Cart();

// Products
$lemon = new \Vouchercodes\Product\Lemon();
$tomato = new \Vouchercodes\Product\Tomato();

// Add lemons
//$cart->addItem($lemon, 8);
$cart->addItem($lemon, 5);
$cart->addItem($lemon, 10);

// Add tomatoes
//$cart->addItem($tomato, 25);
$cart->addItem($tomato, 20);
$cart->addItem($tomato, 80);
$cart->addItem($tomato, 1);

$length = 0;

foreach($cart->products as $product) {
    $length = strlen(str_replace("\t", "    ", $product->quantity . "\t" . $product->getSku() . "\t" . $product->getTotal() . "\n"));
    print $product->quantity . "\t" . $product->getSku() . "\t" . $product->getTotal() . "\n";
}

print str_repeat('-', $length) . "\n";

print "Total:\t\t" . $cart->getTotalSum() . "\n";

print "--------------------------\n";

foreach($cart->products as $product) {
    print $product->getSku() . "\t" . $cart->getPriceOf($product) . "\n";
}