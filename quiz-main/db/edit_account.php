<?php 
session_start();
include 'db.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลปัจจุบันของผู้ใช้
$sql = "SELECT username FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($current_username);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('edit-account-background.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .edit-account-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            border-radius: 10px;
            text-align: center;
            width: 500px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.2em;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #00bfff;
            color: white;
            margin-top: 20px;
        }

        a {
            color: white;
            display: inline-block;
            margin-top: 20px;
            font-size: 1.2em;
            text-decoration: underline;
        }

        input[type="submit"]:hover, a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="edit-account-container">
        <h1>Edit Account</h1>
        <form action="edit_account_process.php" method="post">
            <label>Current Username:</label>
            <input type="text" name="current_username" value="<?php echo htmlspecialchars($current_username); ?>" disabled><br>
            
            <label>New Username:</label>
            <input type="text" name="new_username" required><br>
            
            <label>New Password:</label>
            <input type="password" name="new_password" required><br>
            
            <input type="submit" value="Update">
        </form>
        
        <a href="index.php">Cancel</a>
    </div>
</body>
</html>
