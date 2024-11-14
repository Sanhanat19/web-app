<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please login first!";
    exit;
}

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('quiz-background.jpg');
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quiz-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 50px;
            border-radius: 10px;
            text-align: center;
            width: 600px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        button#edit {
            background-color: grey;
            color: white;
        }

        button#delete {
            background-color: red;
            color: white;
        }

        button#submit {
            background-color: blue;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <?php
        if ($result->num_rows > 0) {
            echo '<form method="POST" action="result.php">';
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row['question'] . "</p>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='1'>" . $row['option1'] . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='2'>" . $row['option2'] . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='3'>" . $row['option3'] . "<br>";
                echo "<input type='radio' name='question_" . $row['id'] . "' value='4'>" . $row['option4'] . "<br>";
            }
            echo '<button type="submit">Submit</button>';
            echo '</form>';
            echo '<br><a href="edit_account.php"><button>Edit Account</button></a>';
            echo '<a href="delete_account.php"><button>Delete Account</button></a>';
        } else {
            echo "No questions found!";
        }
        ?>
    </div>
</body>
</html>
