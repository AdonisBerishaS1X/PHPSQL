<?php
include "../php/auth.php";
include "../php/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO wikis (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input name="title" placeholder="Faction Name" required>
    <textarea name="content" placeholder="Wiki content..." required></textarea>
    <button type="submit">Save</button>
</form>
