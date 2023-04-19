<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "course_work";

try {
	$connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    debug_to_console("Connected successfully");
	
} catch(PDOException $e) {
	debug_to_console( "Connection failed: " . $e->getMessage());
}


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



?>