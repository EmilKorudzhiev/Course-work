<?php 
require('database_connection.inc.php');

$id = $_POST["id"];
$quantity = $_POST["quantity"];

$status = "Correct info";
$_SESSION["CART"][$id] += $quantity;

echo "Added to cart";
?>