<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Warhammer 40,000 Codex</title>

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: "Segoe UI", sans-serif;
		}

		body {
			background-color: #0f1115;
			color: #e6e6e6;
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

		.login-btn {
			padding: 6px 14px;
			border: 1px solid #c9a24d;
			border-radius: 6px;
			color: #c9a24d;
			transition: background 0.3s;
		}

		.login-btn:hover {
			background-color: #c9a24d;
			color: #0f1115;
		}

		.welcome {
			text-align: center;
			margin: 50px 0;
		}

		.welcome p {
			color: #9da5b4;
			margin-top: 10px;
		}

		.faction-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 25px;
			padding: 0 40px 60px;
		}

		.faction-card {
			background-color: #1c1f26;
			border-radius: 12px;
			overflow: hidden;
			cursor: pointer;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		.faction-card:hover {
			transform: translateY(-8px);
			box-shadow: 0 0 20px rgba(201, 162, 77, 0.4);
		}

		.faction-card img {
			width: 100%;
			height: 220px;
			object-fit: cover;
		}

		.faction-card h3 {
			padding: 15px;
			text-align: center;
			color: #c9a24d;
		}

		.faction-card.custom {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			text-align: center;
			padding: 30px;
		}

		.faction-card.custom p {
			color: #9da5b4;
			margin-top: 10px;
		}

		footer {
			background-color: #1c1f26;
			text-align: center;
			padding: 20px;
			color: #9da5b4;
		}

		/* Responsive */
		@media (max-width: 1000px) {
			.faction-grid {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		@media (max-width: 600px) {
			.faction-grid {
				grid-template-columns: 1fr;
			}
		}
	</style>

	<script>
		function goToFaction(name) {
			alert(name + " page coming soon!");
		}

		function goToCustomWiki() {
			<?php if($loggedIn) echo 'window.location.href = "create.php";'; else echo 'alert("you are not logged in!");'; ?>
		}
	</script>
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

<main>
	<section class="welcome">
		<h2>Welcome to the Grim Darkness of the Far Future</h2>
		<p>Explore the greatest factions of the 41st Millennium</p>
	</section>

	<section class="faction-grid">

		<a href="ultramarines.php" style="text-decoration:none;">
			<div class="faction-card">
				<img src="blue.jpg" alt="Ultramarines">
				<h3>Ultramarines</h3>
			</div>
		</a>

		<a href="Ork.php" style="text-decoration:none;">
			<div class="faction-card">
				<img src="wagh.jpg" alt="Orks">
				<h3>Orks</h3>
			</div>
		</a>

		<a href="BlackLegion.php" style="text-decoration:none;">
			<div class="faction-card">
				<img src="BLK.jpg" alt="Black Legion">
				<h3>Black Legion</h3>
			</div>
		</a>

		<div class="faction-card custom" onclick="goToCustomWiki()">
			<h3>Create Your Own Wiki</h3>
			<p>Homebrew or canon — forge your legacy</p>
		</div>

	</section>
</main>

<footer>
	<p>© 2026 Warhammer Fan Project</p>
</footer>

</body>
</html>
