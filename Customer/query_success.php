<?php
include 'connect.php'; // Include your database connection script

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phoneNum'];
$country = $_POST['country'];
$query = $_POST['query'];

// Generate the primary key (srNum) automatically
// Assuming srNum is an auto-increment field in your MySQL table
// You don't need to insert a value for srNum, MySQL will handle it automatically
// Assuming your MySQL table structure is (firstName, lastName, email, phoneNum, country, query, ans, srNum)

// Insert data into the table
$query = "INSERT INTO querycus (firstName, lastName, email, phoneNum, country, query) VALUES ('$firstName', '$lastName', '$email', '$phone', '$country', '$query')";

if (mysqli_query($conn, $query)) {
    echo "<script>confirm('Query submitted successfully!');</script>";
    header("Location: customer.html");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
