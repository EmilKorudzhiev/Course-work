<?php

require('components/database_connection.inc.php');

$sql = "SELECT * FROM shop";
$result = $connection->query($sql);



while($row = $result->fetch()){

$myfile = fopen("controllers\product\\".$row["id"].".php" , "w") or die("Unable to open file!");
$txt = "
<?php
\$active = \"\";
\$id = \"".$row["id"]."\";
\$name = \"".$row["name"]."\";
\$description = \"".$row["description"]."\";
\$price = \"".$row["price"]."\";
\$image = \"".$row["item_image"]."\";

require('../../components/database_connection.inc.php');

require('../../components/header.inc.php');

include('../../components/product_body.inc.php');

require('../../components/footer.inc.php');
?>";

fwrite($myfile, $txt);

fclose($myfile);

}
?>

$_SESSION['sds'] = $user;