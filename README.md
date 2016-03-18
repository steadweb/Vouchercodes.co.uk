# Vouchercodes.co.uk - Cart

A simple component to demonstrate how to contain products in a cart with different levels of discounts.

## Pre-requites 

All commands provided within this README are Linux based. These can be adapted for other systems. The code has been tested using PHP `5.5.9` - short array syntax has been used (PHP `5.3` will not work).

## Core

Main core classes which abstract `Cart`, `Product` and `Discount` functionality. `Item.php` glues the product, quantity and cart together. The `Discount.php` class aids discounts products.  

- Cart.php
- Item.php
- Product.php
- Discount.php

## Products

These extend the core `Product.php` class which provide abstract methods for the `Cart.php` to use. The following products are supported:

- Tomato.php
- Lemon.php

## Pricing Tiers

The following pricing tiers are as follows:

### Lemons

- 0 to 10 = 0.50
- 10+ = 0.45

### Tomatoes

- 0 to 20 = 0.20
- 20 to 100 = 0.18
- 100+ = 0.14

## Example usage

The following script is a CLI example of how the code works. The cart is outputted to the terminal as requested. Firstly, copy the script and create a new `.php` file with `+x` permissions:

```
$ touch index.php
$ chmod +x index.php
```

Then copy and paste the below into the `index.php` file (this has already been provided within the `.zip`). Finally, use the following command to run the example:

```
php ./index.php
```

The script below shows how the API works:

```
<?php

require_once('vendor/autoload.php');

// Cart
$cart = new \Vouchercodes\Cart\Cart();

// Products
$lemon = new \Vouchercodes\Product\Lemon();
$tomato = new \Vouchercodes\Product\Tomato();

// Add lemons
$cart->addItem($lemon, 10);
$cart->addItem($lemon, 15);

// Add tomatoes
$cart->addItem($tomato, 20);
$cart->addItem($tomato, 80);
$cart->addItem($tomato, 1);

$length = 0;

foreach($cart->products as $item) {
    $length = strlen(str_replace("\t", "    ", trim($item->getQuantity() . "\t" . $item->product()->getSku() . "\t" . $item->getTotal())));
    print $item->getQuantity() . "\t" . $item->product()->getSku() . "\t" . $item->getTotal() . "\n";
}

print str_repeat('-', $length) . "\n";

print "Total:\t\t" . $cart->getTotalSum() . "\n";

```

Expected output of the above

```
25      Lemon   11.75
101     Tomato  18.54
----------------------
Total:          30.29
```

Getting the product prices after discounts have been applied:

```
print str_repeat('-', $length) . "\n";

foreach($cart->products as $item) {
    print $item->product()->getSku() . "\t" . $cart->getPriceOf($item->product()) . "\n";
}
```

Expected output of prices after discounts have been applied:

```
----------------------
Lemon   0.45
Tomato  0.14
```

## Tests

Unit tests included which provides 100% coverage. Run the following command to run tests:

```
vendor/bin/phpunit ./tests
```

If you want to generate a coverage report (plugin required), then use the following command:

```
vendor/bin/phpunit --coverage-html=./output ./tests  
```

Coverage will produce a HTML report into the `./output` directory within the current working directory.

```
PHPUnit 4.5.1 by Sebastian Bergmann and contributors.

.................

Time: 1.89 seconds, Memory: 15.50Mb

OK (17 tests, 48 assertions)

Generating code coverage report in HTML format ... done
```

## How I went about implementing this

### 1st Sprint

I basically outlined the tests and created the basic `Cart.php` class which adheres to the interface. I then created the abstract `Product.php` class with abstract methods for the cart to use. `Tomato` and `Lemon` extended `Product` and set the relevant values (price, sku). 

Discounts, at this point, are an array of arrays, not an array of `Discount` objects. Each representing the pricing tiers, for example, `Lemon` only having one array element which defined the amount of products required to discount each product thereon by.

Finally added logic to display the results.

### 2nd Sprint

Added `Item.php` which glues the `Product.php`, `Cart.php` and the amount together, instead of having the amount (quantity) on the `Product.php` class. 

`Discount.php` was also added to support operators.

## Known issues

List of observations and known issues during the first two sprints.

- Discounts need to be in order by threshold in descending order. 


