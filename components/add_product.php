<?php
require('database_connection.inc.php');

$name = $_POST["productName"];
$description = $_POST["productDescription"];
$price = $_POST["productPrice"];
$images = $_FILES["productImage"];
$tags = $_POST["tags"];

$sqlInsertProduct ='
INSERT INTO products (name, description, price)
VALUES (?,?,?);
';

$insertProduct = $connection -> prepare($sqlInsertProduct);

$insertProduct->execute([$name, $description, $price]);
$product_id = $connection -> lastInsertId();

$sqlInsertImage = '
INSERT INTO images (products_id, path) 
VALUES (?,?);
';

$insertImage = $connection->prepare($sqlInsertImage);

foreach ($images["name"] as $key => $img) {
  if ( $images["type"][$key] != "image/jpeg" && $images["type"][$key] != "image/png" && $images["type"][$key] != "image/jpeg") {
		
		echo $images["name"][$key]." Това не е снимка";
		
	} else {
		move_uploaded_file($images["tmp_name"][$key], "../images/shop items/".$product_id."_".$key.".jpg");  
    $insertImage->execute([$product_id, $product_id."_".$key.".jpg"]);
  }

}


$sqlInsertTag = '
INSERT INTO products_has_tags (products_id, tags_id) 
VALUES (?,?)
';
$insertTag = $connection->prepare($sqlInsertTag);

foreach ($tags as $tag_id) {
  $insertTag -> execute([$product_id, $tag_id]);
}
?>