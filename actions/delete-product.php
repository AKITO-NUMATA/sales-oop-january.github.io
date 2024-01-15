<?php
session_start();
require '../classes/Product.php';

$product_obj= new Product;
$product_id=$_GET["product_id"];
$product = $product_obj->delete($product_id)

?>