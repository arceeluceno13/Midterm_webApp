<?php
include('db_connect.php'); 
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set content type for plain text output
header('Content-Type: text/plain; charset=utf-8');

// Prepare and execute SQL query
$sql = "SELECT user_id, name, email, message, created_at FROM users";
$result = $conn->query($sql);

// Check query execution
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Output query results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "User_ID: " . $row["user_id"] . "\n";
        echo "Name: " . $row["name"] . "\n";
        echo "Email: " . $row["email"] . "\n";
        echo "Message: " . $row["message"] . "\n"; 
        echo "Created At: " . $row["created_at"] . "\n";
        echo str_repeat('-', 60) . "\n"; // Cleaner separator
    }
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>
