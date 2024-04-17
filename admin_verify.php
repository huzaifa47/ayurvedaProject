<?php
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM admin WHERE UserName=? AND Password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username; 


    header("Location: loggedin.php");
    exit(); 
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
