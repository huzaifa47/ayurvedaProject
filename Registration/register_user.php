<?php
include 'connect.php';

// Retrieve username and password from the registration form
$user = $_POST['user'];
$password = $_POST['password'];
$email = $_POST['email'];

$first = $_POST['firstName'];


// SQL query to insert the user's information into the database
$sql = "INSERT INTO customer_info (user, password, email, firstName) VALUES ('$user', '$password','$email','$first')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
