<?php
include('db.php'); 

$searchId = isset($_GET['search_id']) ? $_GET['search_id'] : ''; 

$sql = "SELECT * FROM users LEFT OUTER JOIN posts ON users.id = posts.user_id";


if ($searchId !== '') {
    $sql .= " WHERE users.id = '$searchId'";
}


$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ</title>
</head>
<body>

<a href="index.php"><button>Home</button></a>

<form method="GET" action="">
    <label for="search_id">Search by ID:</label>
    <input type="number" name="search_id" id="search_id" value="<?php echo htmlspecialchars($searchId); ?>" />
    <button type="submit">Search</button>
</form>

<br>

<?php
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Title</th><th>Content</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["content"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
