<?php
include "../php/auth.php";
include "../php/db.php";

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$conn->query("DELETE FROM wikis WHERE id=$id AND user_id=$user_id");
header("Location: dashboard.php");
