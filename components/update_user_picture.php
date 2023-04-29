<?php
require('database_connection.inc.php');

$file_name = $_FILES['picture']['name'];
$file_temp = $_FILES['picture']['tmp_name'];
$file_type = $_FILES['picture']['type'];

$sqlGetUser= '
SELECT *
FROM users
WHERE email = (?); 
';
$user = $connection -> prepare($sqlGetUser);
$user -> execute([$_SESSION["USER"][3]]);
$userResult = $user -> fetch();


$sqlUpdateUserPicture= '
UPDATE users 
SET picture = (?)
WHERE email = (?);
';
$updatePicture = $connection -> prepare($sqlUpdateUserPicture);

if ( $file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/jpg" ) {
		
    echo "Качете jpg, jpeg или png снимка";
    
} else {
    $updatePicture -> execute([$userResult["id"].".jpg", $_SESSION["USER"][3]]);
    move_uploaded_file( $file_temp, "../images/profile/".$userResult["id"].".jpg" );
    $_SESSION["USER"] = [$_SESSION["USER"][0], $_SESSION["USER"][1], $_SESSION["USER"][2], $_SESSION["USER"][3], $userResult["id"].".jpg", $_SESSION["USER"][5]];
}

?>