<?php
include 'connect.php';

// Retrieve username and password from the registration form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to insert the user's information into the database
$sql = "INSERT INTO admin (UserName, Password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
