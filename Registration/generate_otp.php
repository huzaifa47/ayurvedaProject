<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';
require 'connect.php';
session_start();

function generateOTP() {
    return rand(100000, 999999);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $otp = generateOTP();
    
    // Store OTP in database
    $query = "INSERT INTO users (email, otp) VALUES ('$email', '$otp')";
    mysqli_query($conn, $query);

    // Email exists, proceed with sending OTP
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lorem.ipsum.sample.email@gmail.com'; // Replace with your Gmail username
        $mail->Password = 'tetmxtzkfgkwgpsc'; // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('lorem.ipsum.sample.email@gmail.com', 'Cinestudio'); // Replace with your Gmail username and desired sender name
        $mail->addAddress($email);
        $mail->addReplyTo('lorem.ipsum.sample.email@gmail.com', 'Cinestudio'); // Replace with your Gmail username and desired sender name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset for platform';
        $mail->Body = "Your OTP for password reset is: $otp";

        $mail->send();

        // Set the OTP in a session variable
        $_SESSION['otp'] = $otp;
        // Store email in session
        $_SESSION['email'] = $email;

        echo "
            <script>
            alert('Message was sent successfully. Thank you for reaching us!');
            window.location.href = '../html/forgot2.html';
            </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
