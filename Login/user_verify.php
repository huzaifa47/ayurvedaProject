<?php
include 'connect.php';

// Retrieve username and password from the login form
$user = $_POST['user'];
$password = $_POST['password'];

// SQL query to retrieve the user's information
$sql = "SELECT * FROM customer_info WHERE user='$user' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
