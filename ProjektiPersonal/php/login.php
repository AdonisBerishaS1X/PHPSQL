<?php
session_start();
include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    if (empty($username) || empty($password)) {
        $error = "Please fill in all the fields";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if (!$user) {
            $error = "The username does not exist";
        } else {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../index.php');
                exit();
            } else {
                $error = "The password is incorrect";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – Warhammer Codex</title>

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
    <h2>Login</h2>

    <?php if (isset($_GET['registered'])): ?>
        <div class="success" style="color:#4caf50;text-align:center;margin-bottom:15px;">Registration successful! Please log in.</div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        <p>No account?</p>
        <a href="register.php">Create one</a>
    </div>
</div>

</body>
</html>
