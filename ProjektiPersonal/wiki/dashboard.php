<?php
include "../php/auth.php";
include "../php/config.php";

$user_id = $_SESSION["user_id"];
$result = mysqli_query($conn, "SELECT * FROM wikis WHERE user_id = $user_id");
?>

<h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
<a href="create.php">Create New Wiki</a>
<a href="../php/logout.php">Logout</a>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div>
        <h3><?php echo $row["title"]; ?></h3>
        <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
    </div>
<?php endwhile; ?>
