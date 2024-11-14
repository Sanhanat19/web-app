<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบผู้ใช้งานในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $username;
        header("Location: quiz.php");
        exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('login-background.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .login-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            border-radius: 10px;
            text-align: center;
        }

        .login-container h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: white;
        }

        .login-container input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
        }

        .login-container button {
            width: 40%;
            padding: 10px;
            font-size: 1.5em;
            border: none;
            background-color: #00bfff;
            color: white;
            cursor: pointer;
            margin: 20px 10px;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="login.php">
            <h2>Login</h2>
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        <a href="register.php" style="color: white;">Register</a>
    </div>
</body>
</html>
