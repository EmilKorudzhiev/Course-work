<?php
session_start();
require("../accessDetails/databaseDetails.php");
try {
	$connection = new PDO("mysql:host="._DB_SERVER_NAME.";dbname="._DB_SCHEMA, _DB_USERNAME, _DB_PASSWORD);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //debug_to_console("Connected successfully");
	
} catch(PDOException $e) {
	//debug_to_console( "Connection failed: " . $e->getMessage());
}


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>