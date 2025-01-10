<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql_check_user = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql_check_user);

    if ($result->num_rows > 0) {

        $sql_delete_posts = "DELETE FROM posts WHERE user_id='$id'";

        if ($conn->query($sql_delete_posts) === TRUE) {

            $sql_delete_user = "DELETE FROM users WHERE id='$id'";

            if ($conn->query($sql_delete_user) === TRUE) {
                echo "User and related posts deleted successfully!";
            } else {
                echo "Error deleting user: " . $conn->error;
            }
        } else {
            echo "Error deleting related posts: " . $conn->error;
        }
    } else {
        echo "ID not found";
    }
}

$conn->close();
?>

<form method="POST">
    ID: <input type="number" name="id" required><br>
    <button type="submit">Delete</button>
</form>
<br>

<a href="index.php"><button>Home</button></a>
