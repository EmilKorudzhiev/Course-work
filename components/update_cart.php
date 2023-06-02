<?php 
require('database_connection.inc.php');

$id = $_POST["id"];
$quantity = $_POST["quantity"];


if(isset($_SESSION["CART"][$id])){
    $_SESSION["CART"][$id] += $quantity;
}else{
    $_SESSION["CART"][$id] = $quantity;
}
echo $id;
echo print_r($_SESSION);
echo "Added to cart";
?>