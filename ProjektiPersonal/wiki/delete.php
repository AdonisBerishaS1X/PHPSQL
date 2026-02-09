<?php
include "../php/auth.php";
include "../php/config.php";

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

mysqli_query($conn, "DELETE FROM wikis WHERE id=$id AND user_id=$user_id");
header("Location: dashboard.php");
