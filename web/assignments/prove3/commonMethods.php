<?php
session_start();
//start the session

// Initialize products
$products = array("Burger and Fries", "Pancakes", "Salad");
$_SESSION["product list"] = $products;
$productImages = array("productImages/burger.jpg", "productImages/pancakes.jpg", "productImages/salad.jpg");
$_SESSION["product images"] = $productImages;
$amounts = array("6.99", "5.99", "3.59");
$_SESSION["price list"] = $amounts;

// Load Session
if ( !isset($_SESSION["total"]) ) {
    $_SESSION["total"] = 0;
    for ($i=0; $i< count($products); $i++) {
        $_SESSION["qty"][$i] = 0;
        $_SESSION["amounts"][$i] = 0;
    }
}

//Add to cart
if ( isset($_GET["add"]) )
{
    $i = $_GET["add"];
    $qty = $_SESSION["qty"][$i] + 1;
    $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    $_SESSION["cart"][$i] = $i;
    $_SESSION["qty"][$i] = $qty;
}

//Delete
if ( isset($_GET["delete"]) )
{
    $i = $_GET["delete"];
    $qty = $_SESSION["qty"][$i];
    $qty--;
    $_SESSION["qty"][$i] = $qty;
    //remove item if quantity is zero
    if ($qty <= 0) {
        $_SESSION["qty"][$i] = 0;
        $qty = $_SESSION["qty"][$i];
        $_SESSION["amounts"][$i] = 0;
        unset($_SESSION["cart"][$i]);
    }
    else
    {
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    }
}

// Get the provided scroll position if it exists, otherwise put 0
$scrollPos = (array_key_exists('scroll', $_GET)) ? $_GET['scroll'] : 0;

// Redirect back to index.php and provide the scroll position as a hash value
?>
