<?php
// Handle wiki editing
session_start();
include_once "php/config.php";

// Check if not authenticated
if (!isset($_SESSION['user_id'])) {
    echo "<!DOCTYPE html><html><body><script>alert('you are not logged in!');</script></body></html>";
    exit();
}

$user_id = $_SESSION['user_id'];
$wiki_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch existing wiki
$stmt = $conn->prepare("SELECT title, lore FROM custom_wikis WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $wiki_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$wiki = $result->fetch_assoc();

if (!$wiki) {
    echo "Wiki not found.";
    exit();
}

$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $lore = trim($_POST['lore']);
    if (empty($title) || empty($lore)) {
        $error = "Title and lore are required.";
    } else {
        $updateStmt = $conn->prepare("UPDATE custom_wikis SET title = ?, lore = ? WHERE id = ? AND user_id = ?");
        $updateStmt->bind_param("ssii", $title, $lore, $wiki_id, $user_id);
        if ($updateStmt->execute()) {
            $success = "Wiki updated successfully!";
            // Refresh data
            $wiki['title'] = $title;
            $wiki['lore'] = $lore;
        } else {
            $error = "Error updating wiki.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Wiki – Warhammer 40,000 Codex</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 80vh;
            justify-content: flex-start;
            padding: 40px;
        }
        .wiki-form {
            background-color: #1c1f26;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 0 25px rgba(201, 162, 77, 0.4);
        }
        .wiki-form h2 {
            text-align: center;
            color: #c9a24d;
            margin-bottom: 25px;
        }
        .wiki-form label {
            display: block;
            margin-bottom: 8px;
            color: #e6e6e6;
        }
        .wiki-form input, .wiki-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #0f1115;
            border: 1px solid #9da5b4;
            border-radius: 6px;
            color: #e6e6e6;
        }
        .wiki-form input:focus, .wiki-form textarea:focus {
            outline: none;
            border-color: #c9a24d;
        }
        .wiki-form button {
            width: 100%;
            padding: 10px;
            background-color: #c9a24d;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            color: #0f1115;
        }
        .wiki-form button:hover {
            opacity: 0.9;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
        }
        .message.error {
            background-color: #ff6b6b;
            color: #fff;
        }
        .message.success {
            background-color: #4caf50;
            color: #fff;
        }
    </style>
</head>
<body>
<header>
    <h1>Warhammer 40,000 Codex</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="mywikis.php">My Wikis</a>
        <a href="create.php">Create Wiki</a>
        <a href="php/logout.php">Logout</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="rules.html">Rules</a>
    </nav>
</header>
<main class="main-content">
    <form class="wiki-form" method="POST">
        <h2>Edit Wiki</h2>
        <?php if ($error): ?><div class="message error"><?php echo $error; ?></div><?php endif; ?>
        <?php if ($success): ?><div class="message success"><?php echo $success; ?></div><?php endif; ?>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($wiki['title']); ?>" required>
        <label for="lore">Lore</label>
        <textarea name="lore" id="lore" required><?php echo htmlspecialchars($wiki['lore']); ?></textarea>
        <button type="submit">Update Wiki</button>
    </form>
</main>
</body>
</html>