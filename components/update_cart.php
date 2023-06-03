<?php 
require('database_connection.inc.php');

$id = $_POST["id"];
$quantity = $_POST["quantity"];


if(isset($_SESSION["CART"][$id])){
    if($_SESSION["CART"][$id]+$quantity<=10){
        $_SESSION["CART"][$id] += $quantity;
    }else{
        $_SESSION["CART"][$id] = 10;
        echo "Даден артикул може да бъде закупен максимално до десет пъти!";
    }
}else{
    $_SESSION["CART"][$id] = $quantity;
}
echo $id;
echo print_r($_SESSION);
echo "Added to cart";
?>