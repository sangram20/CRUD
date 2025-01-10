<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $title = $_POST['title'];  
    $content = $_POST['content'];  

    if (preg_match('/[A-Z]/', $email)) {
        echo "Email must be in lowercase letters only.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (!is_numeric($age) || $age < 18 || $age > 120) {
        echo "Age must be a number between 18 and 120.";
        exit;
    }

    $sql_user = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";
    
    if ($conn->query($sql_user) === TRUE) {

        $user_id = $conn->insert_id;

        $sql_post = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', $user_id)";
        
        if ($conn->query($sql_post) === TRUE) {
            echo "New record created successfully for both user and post!";
        } else {
            echo "Error inserting post: " . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $conn->error;
    }
}

$conn->close();
?>

<form method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="age">Age:</label>
    <input type="number" name="age" id="age" required><br>

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="content">Content:</label>
    <textarea name="content" id="content" required></textarea><br>

    <button type="submit">Insert</button>
</form>

<br>

<a href="index.php"><button>Home</button></a>
