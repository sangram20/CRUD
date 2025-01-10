<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $age = isset($_POST['age']) ? $_POST['age'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;

    $sql_check_user = "SELECT * FROM users WHERE id='$id'";
    $result_user = $conn->query($sql_check_user);

    if ($result_user->num_rows == 0) {
        echo "ID not found.";
    } else {
        $user_updates = [];
        $post_updates = [];

        if ($name !== null && $name !== '') {
            $user_updates[] = "name='$name'";
        }
        if ($email !== null && $email !== '') {
            $user_updates[] = "email='$email'";
        }
        if ($age !== null && $age !== '') {
            $user_updates[] = "age='$age'";
        }
        if ($title !== null && $title !== '') {
            $post_updates[] = "title='$title'";
        }
        if ($content !== null && $content !== '') {
            $post_updates[] = "content='$content'";
        }

        if (count($user_updates) > 0) {
            $sql_user_update = "UPDATE users SET " . implode(", ", $user_updates) . " WHERE id='$id'";
            if ($conn->query($sql_user_update) === TRUE) {
                echo "User record updated successfully!<br>";
            } else {
                echo "Error updating user: " . $conn->error . "<br>";
            }
        }

        if (count($post_updates) > 0) {
            $sql_post_update = "UPDATE posts SET " . implode(", ", $post_updates) . " WHERE user_id='$id'";
            if ($conn->query($sql_post_update) === TRUE) {
                echo "Post record updated successfully!<br>";
            } else {
                echo "Error updating post: " . $conn->error . "<br>";
            }
        }

        if (count($user_updates) === 0 && count($post_updates) === 0) {
            echo "No fields were provided to update.";
        }
    }
}

$conn->close();
?>

<form method="POST">
    ID: <input type="number" name="id" required><br>
    Name: <input type="text" name="name"><br>  
    Email: <input type="email" name="email"><br>  
    Age: <input type="number" name="age"><br>  
    Title: <input type="text" name="title"><br>  
    Content: <textarea name="content"></textarea><br>  
    <button type="submit">Update</button>
</form>
<br>

<a href="index.php"><button>Home</button></a>
