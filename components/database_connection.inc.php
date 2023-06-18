<?php
session_start();
require("../accessDetails/databaseDetails.php");
try {
	$connection = new PDO("mysql:host="._DB_SERVER_NAME.";dbname="._DB_SCHEMA, _DB_USERNAME, _DB_PASSWORD);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>