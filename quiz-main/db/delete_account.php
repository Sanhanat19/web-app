<?php
session_start();
include 'db.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// ดึงข้อมูลผู้ใช้ (optional)
$sql = "SELECT username FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('delete-account-background.jpg'); /* ใส่ภาพพื้นหลังที่ต้องการ */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .delete-account-container {
            background-color: rgba(0, 0, 0, 0.7); /* กล่องโปร่งแสง */
            padding: 50px;
            border-radius: 10px;
            text-align: center;
            width: 500px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); /* เพิ่มเงา */
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        input[type="submit"], a {
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        input[type="submit"] {
            background-color: red;
            color: white;
        }

        a {
            background-color: grey;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        input[type="submit"]:hover, a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="delete-account-container">
        <h1>Delete Account</h1>
        <p>Are you sure you want to delete your account, <?php echo htmlspecialchars($username); ?>?</p>
        <form action="delete_account_process.php" method="post">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="submit" name="confirm" value="Yes, delete my account">
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
