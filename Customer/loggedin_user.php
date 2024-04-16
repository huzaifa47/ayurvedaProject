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
include 'connect.php'; // Include your database connection script

$query = "SELECT firstName, lastName, email, phoneNum, country, query,ans FROM querycus WHERE firstName = '$username1'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abbas Bhai Kaderbhai vaid</title>
    <link rel="icon" href="img/ak.png">
    <link rel="stylesheet" href="customer.css">
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
<div style="height: 150px;"></div>
<h1 align=center>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>
<div style="height: 50px;"></div>

<h2 style="padding-left:20px">Your Queries :</h2>
<div class="total1">
        </div>
        <div class="quer">
<table  width=90% style="font-size:20px;margin:auto" >
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Country</th>
            <th>Query</th>
            <th>Ans</th>

        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phoneNum']); ?></td>
                <td><?php echo htmlspecialchars($row['country']); ?></td>
                <td><?php echo htmlspecialchars($row['query']); ?></td>
                <td><?php echo htmlspecialchars($row['ans']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<div style="height: 50px;"></div>
<div class="total">
        </div>
        <div class="box">
            <h1 class="valuee">Talk with our <br>sales team</h1>
            <h1 class="tell">Fill out your information and an Employee<br> representative will reach out to you. Have
                a<br>
                simple question?<span id="gg"> Check out our FAQ</span>.
        </div>
        <div class="form-container">
            <form action="query_success.php" method="post" id="form">

                <div class="form-group">
                    <label for="first-name">User Name</label>
                    <input type="text" id="first-name" name="firstName" value="<?php echo htmlspecialchars($username1); ?>"  readonly required>
                </div>
                <div class="form-group">
                    <label for="last-name">Name</label>
                    <input type="text" id="last-name" name="lastName" placeholder="Smith" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="name@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phoneNum" placeholder="+1 555 655 5656" required>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country" required>
                        <option value="">Select</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">UK</option>
                        <option value="Australia">Australia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discussion-topic">What would you like to discuss:</label>
                    <textarea id="discussion-topic" name="query"
                        placeholder="Share your Ayurvedic health concerns or questions here." required></textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="privacy-checkbox" required>
                    <label for="privacy-checkbox">By checking the box and clicking "Submit", you are agreeing to our
                        Privacy Statement</label>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
        </div>

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