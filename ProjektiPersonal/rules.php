<?php session_start(); $loggedIn = isset($_SESSION['user_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Rules – Warhammer 40,000 Codex</title>
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
    <h2>Community Rules</h2>
    <p>Welcome to the Warhammer 40,000 Codex community! To ensure a positive and respectful environment for all fans of the grim darkness of the far future, please adhere to the following rules. These guidelines apply to all content, including custom wikis, comments, and interactions on this site.</p>
    
    <h3>1. Accuracy and Truthfulness</h3>
    <p>All information provided in wikis, lore, and discussions must be accurate and based on official Warhammer 40,000 sources or clearly marked as fan-made content. Misinformation, deliberate falsehoods, or spreading unverified rumors is strictly prohibited.</p>
    
    <h3>2. No Advertising or Promotion</h3>
    <p>Do not use your wikis or any part of this site to advertise products, services, or external websites. This includes subtle promotions disguised as content. The focus should remain on sharing Warhammer 40,000 knowledge and creativity.</p>
    
    <h3>3. Respect and No Hate Speech</h3>
    <p>Hate speech, racism, sexism, homophobia, or any form of discrimination is not tolerated. This includes content that disguises bigotry through Warhammer themes, characters, or allegories. Treat all community members with respect, regardless of their views on factions, playstyles, or interpretations of the lore.</p>
    
    <h3>4. Original Content and Intellectual Property</h3>
    <p>Respect the intellectual property of Games Workshop and other creators. Do not steal, copy, or plagiarize the work of others. Your custom wikis should be original creations. If referencing official material, give proper credit. Fan art and homebrew content is encouraged, but must not infringe on copyrights.</p>
    
    <h3>5. Appropriate Content</h3>
    <p>Keep all content appropriate for a general audience. Avoid excessive violence, explicit material, or anything that could be considered offensive. Warhammer 40,000 is dark, but we maintain standards to keep the community welcoming.</p>
    
    <h3>6. No Spam or Disruption</h3>
    <p>Do not spam the site with repetitive posts, irrelevant content, or attempts to disrupt discussions. Use the features provided (like creating wikis) responsibly.</p>
    
    <h3>7. Privacy and Safety</h3>
    <p>Do not share personal information about yourself or others. Respect user privacy. Report any suspicious or harmful behavior to the site administrators.</p>
    
    <h3>8. Consequences</h3>
    <p>Violations of these rules may result in content removal, account suspension, or permanent bans. We aim to be fair, but maintaining a positive community is our top priority.</p>
    
    <p>If you have questions about these rules or need clarification, feel free to contact us. Enjoy building your corner of the Galaxy!</p>
</main>
</body>
</html>