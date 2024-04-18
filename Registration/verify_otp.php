<?php
include 'connect.php';

// Handle request to verify OTP
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];
    $enteredOTP = $_GET["otp"];

    // Retrieve OTP from database
    $query = "SELECT otp FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $storedOTP = $row['otp'];

    // Compare entered OTP with stored OTP
    if ($enteredOTP == $storedOTP) {
        // OTP is correct
        echo "success";
    } else {
        // OTP is incorrect
        echo "failure";
    }
}
?>
