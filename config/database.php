<?php
// used to connect to the database
$host = "localhost";
$db_name = "1phpbeginnercrudlevel1";
$username = "root";
$password = "";

try {
	$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
} catch(PDOException $exception) {
	echo "Connection error: " . $exception->getMessage();
}
?>