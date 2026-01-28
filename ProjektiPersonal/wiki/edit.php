<?php
include "../php/auth.php";
include "../php/db.php";

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$result = $conn->query("SELECT * FROM wikis WHERE id=$id AND user_id=$user_id");
$wiki = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $conn->query("UPDATE wikis SET title='$title', content='$content' WHERE id=$id");
    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input name="title" value="<?php echo $wiki["title"]; ?>">
    <textarea name="content"><?php echo $wiki["content"]; ?></textarea>
    <button>Update</button>
</form>
