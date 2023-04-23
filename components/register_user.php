<?php
require('database_connection.inc.php');

$name = $_POST["name"];
$surname = $_POST["surname"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$password = hash("sha256",$_POST["password"]);

$sqlInsertNewUser = '
INSERT INTO users (first_name, last_name, phone, email, password) VALUES (?, ?, ?, ?, ?);
';

$sqlCheckEmail='
SELECT * FROM users
WHERE email = (?);
';

$result = $connection -> prepare($sqlInsertNewUser);

$emailCheck = $connection -> prepare($sqlCheckEmail);
$emailCheck -> execute([$email]);
$emailCheckResult = $emailCheck -> fetch();

if($emailCheckResult){
    echo"Email already used. Please use another.";
    
}else{
    $result -> execute([$name, $surname, $phone, $email, $password]);
    echo "Registered successfully";
    $_SESSION["USER"] = [$_POST["name"], $_POST["surname"], $_POST["phone"], $_POST["email"], null];
}
?> 