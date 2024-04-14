<?php

session_start();


if (isset($_SESSION['user'])) {
    $username1 = $_SESSION['user'];
} else {

    header("Location: part.html");
    exit();
}


setcookie('session_check', 'session_active', time() + 60, '/'); // Adjust the lifetime as needed (e.g., 60 seconds)


$username1 = $_SESSION['user'];

echo "Welcome $username1";