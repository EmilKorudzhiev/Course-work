<?php                  
session_start();
unset($_SESSION["USER"]);
header("Location: /Course-work/controllers/home.php");
?>