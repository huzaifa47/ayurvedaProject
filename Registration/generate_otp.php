<?php
include 'connect.php';

// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999);
}

// Handle request to generate OTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = generateOTP();

    // Store OTP in database
    $query = "INSERT INTO users (email, otp) VALUES ('$email', '$otp')";
    mysqli_query($conn, $query);

    // Send OTP to user (you can use PHPMailer or other libraries for email sending)
    // For demonstration, just print the OT
}
?>
