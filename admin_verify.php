<?php
include 'connect.php';

// Retrieve username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to retrieve the user's information
$sql = "SELECT * FROM admin WHERE UserName='$username' AND Password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
