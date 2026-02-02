<?php
include_once "config.php";


include_once "config.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "You have not filled all the fields";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check for duplicate username (PDO)
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = "An account with that username already exists.";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $password_hashed])) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $error = "Error creating account.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register – Warhammer Codex</title>
    <style>
        body {
            background-color: #0f1115;
            color: #e6e6e6;
            font-family: "Segoe UI", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: #1c1f26;
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 25px rgba(201, 162, 77, 0.4);
        }
        h2 {
            text-align: center;
            color: #c9a24d;
            margin-bottom: 25px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #0f1115;
            border: 1px solid #9da5b4;
            border-radius: 6px;
            color: #e6e6e6;
        }
        input:focus {
            outline: none;
            border-color: #c9a24d;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #c9a24d;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            color: #0f1115;
        }
        button:hover {
            opacity: 0.9;
        }
        .error {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 15px;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #c9a24d;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Register</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <div class="register-link">
        <p>Already have an account?</p>
        <a href="login.php">Login</a>
    </div>
</div>
</body>
</html>
