<?php

session_start();


if (isset($_SESSION['user'])) {
    $username1 = $_SESSION['user'];
} else {

    header("Location: part.html");
    exit();
}


setcookie('session_check', 'session_active', time() + 60, '/'); // Adjust the lifetime as needed (e.g., 60 seconds)


$username1 = $_SESSION['user'];?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abbas Bhai Kaderbhai vaid</title>
    <link rel="icon" href="img/ak.png">
    <link rel="stylesheet" href="customer.css">
</head>

<body>
<header>
        <img src="ak.png" width="75em">
        <h3 id="nameShop">Abbas Bhai Kaderbhai vaid</h3>

        <nav>
            <ul>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>

    </header>
    <div style="height: 100px; ;"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>
    <div style="height: 100px; ;"></div>
    <footer>
        <h2 align="center">Connect With Us</h2>
        <div class="socialMedia">

            <div id="lo"><a href="https://www.facebook.com/voraabbasbhai.kaderbhai/" target="_blank"><img
                        src="facebook.png" width="50px"></a></div>
            <div id="lo"><a
                    href="https://www.justdial.com/Rajkot/Vora-M-Abbasbhai-Kadarbhai-Vaid-Opp-Crystal-Mall-Rajkot-City/0281PX281-X281-120725082405-I2E5_BZDET/"
                    target="_blank"><img src="jd.png" width="50px"></a></div>
            <div id="lo"><a href="https://wa.me/919924337567" target="_blank"><img src="wp.jpg" width="50px"></a>
            </div>
        </div>
        &copy; 2023-2024 Abbas Bhai Kaderbhai vaid<br>
        All Rights Reserved
    </footer>
</body>

</html>