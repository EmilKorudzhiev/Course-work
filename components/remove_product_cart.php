<?php
require('database_connection.inc.php');

$id = $_POST["id"];

unset(
    $_SESSION["CART"][$id]
);
?>