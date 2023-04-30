<?php 
require('database_connection.inc.php');

$tag = $_POST["tagName"];

$sqlInsertNewTag = '
INSERT INTO tags (tag)
VALUES (?);
';

$sqlCheckTag = '
SELECT * FROM tags 
WHERE tag = (?);
';

$insertTag = $connection -> prepare($sqlInsertNewTag);

$checkTag = $connection -> prepare($sqlCheckTag);
$checkTag -> execute([$tag]);
$checkTagResult = $checkTag -> fetch();

if($checkTagResult){
  $status = "tagExists";
  
}else{
  $insertTag -> execute([$tag]);
  $status = "tagDoesntExist";
}

$response = array("status" => $status);
echo json_encode($response);
?>