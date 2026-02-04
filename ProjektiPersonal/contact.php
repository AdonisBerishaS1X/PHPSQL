<?php session_start(); $loggedIn = isset($_SESSION['user_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact – Warhammer 40,000 Codex</title>
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
            max-width: 800px;
            margin: 0 auto;
        }
        .main-content h2 {
            color: #c9a24d;
            text-align: center;
            margin-bottom: 20px;
        }
        .main-content p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<header>
    <h1>Warhammer 40,000 Codex</h1>
    <nav>
        <a href="index.php">Home</a>
        <?php if($loggedIn): ?>
            <a href="mywikis.php">My Wikis</a>
            <a href="create.php">Create Wiki</a>
            <a href="php/logout.php">Logout</a>
        <?php else: ?>
            <a href="php/login.php" class="login-btn">Login</a>
        <?php endif; ?>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="rules.php">Rules</a>
    </nav>
</header>
<main class="main-content">
    <h2>Contact Us</h2>
    <p>You can report any issues and or ideas at bl00dang3l@gmail.com
    </p>
</main>
</body>
</html>