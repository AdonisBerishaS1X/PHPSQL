<?php
include "../php/auth.php";
include "../php/config.php";

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$result = mysqli_query($conn, "SELECT * FROM wikis WHERE id=$id AND user_id=$user_id");
$wiki = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $stmt = mysqli_prepare($conn, "UPDATE wikis SET title=?, content=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
    mysqli_stmt_execute($stmt);
    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input name="title" value="<?php echo $wiki["title"]; ?>">
    <textarea name="content"><?php echo $wiki["content"]; ?></textarea>
    <button>Update</button>
</form>
