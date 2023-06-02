<?php
require('database_connection.inc.php');

$id = $_POST["productId"];

unset(
    $_SESSION["CART"][$id]
);

include("cart_item_display.php");

?>