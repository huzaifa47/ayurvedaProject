<?php
include 'connect.php';

// Retrieve username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query with prepared statement to retrieve the user's information
$sql = "SELECT * FROM admin WHERE UserName=? AND Password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Start a session and set session variables to indicate that the user is logged in
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username; // Set the username in the session

    // Redirect to the logged-in page
    header("Location: loggedin.php");
    exit(); // Make sure to stop execution after redirecting
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
