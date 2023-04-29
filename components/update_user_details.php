<?php
require('database_connection.inc.php');

$firstName = $_POST["firstName"];
$surname = $_POST["surname"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$sqlUpdateUser = '
UPDATE users 
SET first_name = (?), last_name = (?), phone = (?), email = (?)
WHERE email = (?);
';


$result = $connection -> prepare($sqlUpdateUser);


if($result -> execute([$firstName, $surname, $phone, $email, $_SESSION["USER"][3]])){
    $_SESSION["USER"] = [$_POST["firstName"], $_POST["surname"], $_POST["phone"], $_POST["email"], $_SESSION["USER"][4], $_SESSION["USER"][5]];
    echo "Updated successfully";
}else{
    echo "Error updating";
}

?> 