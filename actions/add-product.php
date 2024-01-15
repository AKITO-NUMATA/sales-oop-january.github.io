<?php

include '../classes/Product.php';

// Create an object
$product = new Product;

//call the method
//all date handle $_post
$product->store($_POST);

?>

