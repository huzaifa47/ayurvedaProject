<?php

include_once 'connect.php';


$query = "SELECT COUNT(*) AS count FROM customer_info";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abbas Bhai Kaderbhai vaid</title>
    <link rel="icon" href="img/ak.png">
    <link rel="stylesheet" href="index1.css">
    <style>

        #counter {
            border: 2px solid #333;
            border-radius: 200px;
            font-size: 25px;
            font-weight: bold;
            color: #333;
            background-color: #e0ffc6;
        }
    </style>
    <script>
     
        var count = <?php echo $count; ?>;

        function incrementCounter() {
            var counterElement = document.getElementById('counter');
            var currentCount = 0;
            counterElement.innerHTML = "Successfully logged in customers: <br><h1>" + currentCount + "+</h1><br>You should login too";

            var incrementInterval = setInterval(function () {
                currentCount++;
                counterElement.innerHTML = "Successfully logged in customers: <br><h1>" + currentCount + "+</h1><br>You should login too";
                if (currentCount >= count) {
                    clearInterval(incrementInterval);
                }
            }, 130);
        }

   
        document.addEventListener("DOMContentLoaded", function () {
            incrementCounter();
        });
    </script>
</head>

<body>
    <header>
        <img src="img/ak.png" width="75em">
        <h3 id="nameShop">Abbas Bhai Kaderbhai vaid</h3>

        <nav>
            <ul>
                <li><a href="login/part.php">Log In/Sign Up</a></li>
                <li><a href="admin_login.php">Admin Login</a></li>
                <li><a href="product/product_main.html">Product</a></li>
                <li><a href="homeMade/home.html">HomeMade Remedies</a></li>
            </ul>
        </nav>

    </header>
    <div class="welcomeText">

        <img src="img/tree-background.jpg" id="big">
        <div id="textInimg">Welcome to the <br>World Of Ayurveda</div>
    </div>


    <h2><div align="center" id="counter"></div></h2>

    <h1 align="center"> Our shops</h1>
    <a href="shop/kalavad.html">

        <div class="shops">
            <div class="shop1">
                <img src="img/kalavad.png" width="100%">
                <h3>Kalavad Road</h3>
                <p>Opp. Crystal Mall, Shop no. 20</p>
            </div>
        </a>
        <a href="shop/sheth.html">
            <div class="shop2">
                <img src="img/sheth.png" width="100%">
                <h3>Sheth Nagar</h3>
                <p>Madhapar Chowk , Jamnagar Highway </p>

            </div>
        </a>

    </div>
    <footer>
        <h2 align="center">Connect With Us</h2>
        <div class="socialMedia">

            <div id="lo"><a href="https://www.facebook.com/voraabbasbhai.kaderbhai/" target="_blank"><img
                        src="img/facebook.png" width="50px"></a></div>
            <div id="lo"><a
                    href="https://www.justdial.com/Rajkot/Vora-M-Abbasbhai-Kadarbhai-Vaid-Opp-Crystal-Mall-Rajkot-City/0281PX281-X281-120725082405-I2E5_BZDET/"
                    target="_blank"><img src="img/jd.png" width="50px"></a></div>
            <div id="lo"><a href="https://wa.me/919924337567" target="_blank"><img src="img/wp.jpg" width="50px"></a>
            </div>
        </div>
        &copy; 2023-2024 Abbas Bhai Kaderbhai vaid<br>
        All Rights Reserved
    </footer>

</body>

</html>
