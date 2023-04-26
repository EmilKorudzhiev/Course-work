<?php
require('database_connection.inc.php');

$passwordOld = hash("sha256",$_POST["passwordOld"]);
$passwordNew = hash("sha256",$_POST["passwordNew"]);

$sqlGetUserOldPassword = '
SELECT password 
FROM users
WHERE email = (?); 
';
$oldPass = $connection -> prepare($sqlGetUserOldPassword);
$oldPass -> execute([$_SESSION["USER"][3]]);
$oldPassResult = $oldPass -> fetch();

$sqlUpdateUserPassword = '
UPDATE users 
SET password =(?)
WHERE email = (?);
';
$updatePassword = $connection -> prepare($sqlUpdateUserPassword);

if($oldPassResult['password'] == $passwordOld){
    $updatePassword -> execute([$passwordNew, $_SESSION["USER"][3]]);
}else{
    echo "Wrong password";
}

?>