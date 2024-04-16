<?php
include 'connect.php';

// Retrieve username and password from the login form
$username = $_POST['user'];
$password = $_POST['password'];

// SQL query with prepared statement to retrieve the user's information
$sql = "SELECT * FROM customer_info WHERE user=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Start a session and set session variables to indicate that the user is logged in
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $username; // Set the username in the session

    // Redirect to the logged-in page
    header("Location: ../Customer/loggedin_user.php");
    exit(); // Make sure to stop execution after redirecting
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
