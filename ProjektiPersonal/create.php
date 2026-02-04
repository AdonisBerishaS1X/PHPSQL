<?php
// Handle image uploads and wiki creation
session_start();
include_once "php/config.php";

// Check if not authenticated
if (!isset($_SESSION['user_id'])) {
    echo "<!DOCTYPE html><html><body><script>alert('you are not logged in!');</script></body></html>";
    exit();
}

// Create table if not exists (for demo, production should use migrations)
$conn->query("CREATE TABLE IF NOT EXISTS custom_wikis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    lore TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
$conn->query("ALTER TABLE custom_wikis ADD COLUMN IF NOT EXISTS user_id INT NOT NULL DEFAULT 0");
$conn->query("CREATE TABLE IF NOT EXISTS custom_wiki_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    wiki_id INT,
    image_path VARCHAR(255),
    FOREIGN KEY (wiki_id) REFERENCES custom_wikis(id) ON DELETE CASCADE
)");

$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $lore = trim($_POST['lore']);
    if (empty($title) || empty($lore)) {
        $error = "Title and lore are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO custom_wikis (user_id, title, lore) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $_SESSION['user_id'], $title, $lore);
        if ($stmt->execute()) {
            $wiki_id = $conn->insert_id;
            // Handle images
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir);
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $fileName = basename($_FILES['images']['name'][$key]);
                    $targetFile = $uploadDir . uniqid() . '_' . $fileName;
                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        $imgStmt = $conn->prepare("INSERT INTO custom_wiki_images (wiki_id, image_path) VALUES (?, ?)");
                        $imgStmt->bind_param("is", $wiki_id, $targetFile);
                        $imgStmt->execute();
                    }
                }
            }
            $success = "Wiki created successfully!";
        } else {
            $error = "Error creating wiki.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Your Own Wiki – Warhammer 40,000 Codex</title>
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
        }
        .wiki-form {
            background-color: #1c1f26;
            border-radius: 16px;
            padding: 40px 60px;
            max-width: 700px;
            margin: 40px 0 20px 0;
            box-shadow: 0 0 25px rgba(201, 162, 77, 0.2);
            width: 100%;
        }
        .wiki-form h2 {
            color: #c9a24d;
            margin-bottom: 20px;
            text-align: center;
        }
        .wiki-form label {
            display: block;
            margin-bottom: 8px;
            color: #c9a24d;
        }
        .wiki-form input[type="text"],
        .wiki-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #0f1115;
            border: 1px solid #9da5b4;
            border-radius: 6px;
            color: #e6e6e6;
        }
        .wiki-form textarea {
            min-height: 120px;
            resize: vertical;
        }
        .wiki-form input[type="file"] {
            margin-bottom: 15px;
            color: #e6e6e6;
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
        }
        .success { color: #4caf50; }
        .error { color: #ff6b6b; }
        .uploaded-images {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            margin-top: 20px;
        }
        .uploaded-images img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(201, 162, 77, 0.15);
        }
    </style>
</head>
<body>
<header>
    <h1>Warhammer 40,000 Codex</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="mywikis.php">My Wikis</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="rules.html">Rules</a>
        <a href="php/logout.php">Logout</a>
    </nav>
</header>
<main class="main-content">
    <form class="wiki-form" method="POST" enctype="multipart/form-data">
        <h2>Create Your Own Wiki</h2>
        <?php if ($error): ?><div class="message error"><?php echo $error; ?></div><?php endif; ?>
        <?php if ($success): ?><div class="message success"><?php echo $success; ?></div><?php endif; ?>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>
        <label for="lore">Lore</label>
        <textarea name="lore" id="lore" required></textarea>
        <label for="images">Upload Images</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*">
        <button type="submit">Create Wiki</button>
    </form>
    <?php
    // Show uploaded images for the last created wiki
    if ($success && isset($wiki_id)) {
        $imgRes = $conn->prepare("SELECT image_path FROM custom_wiki_images WHERE wiki_id = ?");
        $imgRes->bind_param("i", $wiki_id);
        $imgRes->execute();
        $result = $imgRes->get_result();
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        if ($images) {
            echo '<div class="uploaded-images">';
            foreach ($images as $img) {
                echo '<img src="' . htmlspecialchars($img['image_path']) . '" alt="Wiki Image">';
            }
            echo '</div>';
        }
    }
    ?>
</main>
</body>
</html>
