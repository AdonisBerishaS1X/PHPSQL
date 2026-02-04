<?php
session_start();
include_once "php/config.php";

// Check if not authenticated
if (!isset($_SESSION['user_id'])) {
    echo "<!DOCTYPE html><html><body><script>alert('you are not logged in!');</script></body></html>";
    exit();
}

// Fetch user's wikis
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    // Delete images first
    $imgStmt = $conn->prepare("SELECT image_path FROM custom_wiki_images WHERE wiki_id = ?");
    $imgStmt->bind_param("i", $delete_id);
    $imgStmt->execute();
    $imgResult = $imgStmt->get_result();
    while ($img = $imgResult->fetch_assoc()) {
        if (file_exists($img['image_path'])) {
            unlink($img['image_path']);
        }
    }
    // Delete images from DB
    $conn->query("DELETE FROM custom_wiki_images WHERE wiki_id = $delete_id");
    // Delete wiki
    $delStmt = $conn->prepare("DELETE FROM custom_wikis WHERE id = ? AND user_id = ?");
    $delStmt->bind_param("ii", $delete_id, $user_id);
    $delStmt->execute();
    // Redirect to refresh
    header("Location: mywikis.php");
    exit();
}
$stmt = $conn->prepare("SELECT id, title, lore, created_at FROM custom_wikis WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$wikis = [];
while ($row = $result->fetch_assoc()) {
    $wikis[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wikis – Warhammer 40,000 Codex</title>
    <style>
        body {
            background-color: #0f1115;
            color: #e6e6e6;
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1c1f26;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            color: #c9a24d;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        nav a {
            color: #e6e6e6;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            color: #c9a24d;
        }
        .main-content {
            padding: 40px;
        }
        .wiki-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .wiki-card {
            background-color: #1c1f26;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(201, 162, 77, 0.2);
        }
        .wiki-card h3 {
            color: #c9a24d;
            margin-bottom: 10px;
        }
        .wiki-card p {
            color: #9da5b4;
            margin-bottom: 10px;
        }
        .wiki-card .date {
            font-size: 0.9em;
            color: #666;
        }
        .wiki-card .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .wiki-card button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .edit-btn {
            background-color: #c9a24d;
            color: #0f1115;
        }
        .edit-btn:hover {
            opacity: 0.9;
        }
        .delete-btn {
            background-color: #ff6b6b;
            color: #fff;
        }
        .delete-btn:hover {
            opacity: 0.9;
        }
        .no-wikis {
            text-align: center;
            color: #9da5b4;
        }
    </style>
</head>
<body>
<header>
    <h1>Warhammer 40,000 Codex</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="create.php">Create Wiki</a>
        <a href="php/logout.php">Logout</a>
    </nav>
</header>
<main class="main-content">
    <h2>My Custom Wikis</h2>
    <?php if (empty($wikis)): ?>
        <p class="no-wikis">You haven't created any wikis yet. <a href="create.php">Create one now!</a></p>
    <?php else: ?>
        <div class="wiki-list">
            <?php foreach ($wikis as $wiki): ?>
                <div class="wiki-card">
                    <h3><?php echo htmlspecialchars($wiki['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($wiki['lore'], 0, 200)) . (strlen($wiki['lore']) > 200 ? '...' : ''); ?></p>
                    <p class="date">Created: <?php echo htmlspecialchars($wiki['created_at']); ?></p>
                    <div class="actions">
                        <a href="edit.php?id=<?php echo $wiki['id']; ?>"><button class="edit-btn">Edit</button></a>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this wiki?')">
                            <input type="hidden" name="delete_id" value="<?php echo $wiki['id']; ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>