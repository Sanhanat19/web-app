<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// เก็บคะแนน
$score = 0;

$sql = "SELECT * FROM questions LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('score-background.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .score-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            font-size: 2em;
        }

        a {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="score-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $question_id = "question_" . $row['id'];
                if (isset($_POST[$question_id]) && $_POST[$question_id] == $row['correct_answer']) {
                    $score++;
                }
            }
        }

        echo "<h2>Your score: $score/5</h2>";
        echo '<a href="quiz.php">Retake Quiz</a>';
        ?>
    </div>
</body>
</html>
