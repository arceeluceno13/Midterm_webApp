<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // para dili ma inject e prevent niya nga musulod sa db ang mga malicious code or script og mga unwanted characters like <script>.
    // just refer to this link https://www.php.net/manual/en/filter.filters.sanitize.php.
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);


    // Prepare an SQL statement for execution
    $stmt = $conn->prepare("INSERT INTO users(name, email, message) VALUES(?, ?, ?)");

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        header("location: ../php/Error.php");
        // echo "Invalid format. Only letters and spaces are allowed.";
        exit;
    }

    if (!preg_match('/^[\w\s.,!?\'"()]+$/', $message)) {
        header("location: ../php/Error.php");
        // echo "Invalid format. Only letters, numbers, and certain punctuation are allowed.";
        exit;
    }

    // Bind variables to the prepared statement as parameters
    // sss stands for string, string, string (3 strings).
    // bind_param() is used to bind variables to the SQL query and tells the database what to expect..
    $stmt->bind_param("sss", $name, $email, $message);

    // Prepare Statement para dili ma inject ang SQL og dili error.
    // Execute the prepared statement
    if ($stmt->execute()) {
        header("location: ../php/thank-you.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method";
}
?>