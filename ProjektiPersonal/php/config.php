<?php
$conn = new mysqli("localhost", "root", "", "wikilogin");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
