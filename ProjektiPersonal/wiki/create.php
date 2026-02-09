<?php
session_start();
include "../php/config.php";

if (!isset($_SESSION["user_id"])) {
    echo "<!DOCTYPE html><html><body><script>alert('you are not logged in!');</script></body></html>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $stmt = mysqli_prepare($conn, "INSERT INTO wikis (user_id, title, content) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $content);
    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input name="title" placeholder="Faction Name" required>
    <textarea name="content" placeholder="Wiki content..." required></textarea>
    <button type="submit">Save</button>
</form>
