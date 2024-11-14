<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบว่าผู้ใช้มีอยู่แล้วหรือไม่
    $checkUser = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows == 0) {
        // เพิ่มผู้ใช้ใหม่ในฐานข้อมูล
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Username already exists!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('register-image.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: white;
            font-size: 36px;
        }

        input[type="text"], input[type="password"] {
            width: 300px;
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 18px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button#cancel {
            background-color: red;
            color: white;
        }

        button#ok {
            background-color: blue;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="register.php">
            <h2>Register</h2>
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php" style="color: white;">Back to Login</a>
    </div>
</body>
</html>
