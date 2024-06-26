<?php

session_start();

if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];
} else {
    header("Location: admin_login.php");
    exit();
}

setcookie('session_check', 'session_active', time() + 60, '/'); // Adjust the lifetime as needed (e.g., 60 seconds)

$username1 = $_SESSION['username'];

include 'connect.php';

// Fetch unique main product values from database
$query = "SELECT DISTINCT mainProduct FROM product_ratio";
$result_main_products = mysqli_query($conn, $query);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered main product and grams
    $mainProduct = $_POST['mainProduct'];
    $grams = $_POST['grams'];

    // Query to select product parts and calculate required grams based on ratio
    $query = "SELECT productPart, ratio * $grams AS requiredGrams FROM product_ratio WHERE mainProduct = '$mainProduct'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Stock</title>
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
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 10px 45%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: center; /* Center-align the labels */
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 50%; /* Reduce the width of the input fields */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 4px;
            margin-bottom: 4px;
            resize: vertical;
            text-align: center;
            display: inline-block; /* Ensure the input fields are in-line */
        }
        input[type="checkbox"] {
            margin-right: 5px;
            vertical-align: middle;
            transform: scale(1.5); /* Adjust the size of the checkbox */
        }
    </style>
    <link rel="stylesheet" type="text/css" href="admin_login.css">
</head>
<body bgcolor="#f4f5dd">
    <header>
        <img src="img/ak.png" width="75em" />
        <h3 id="nameShop">Abbas Bhai Kaderbhai vaid</h3>

        <nav>
            <ul>
                <li><a href="admin_query.php">All Queries</a></li>
                <li><a href="loggedin.php">Inventory</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    
    <div style="height: 100px;"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="mainProduct">Main Product:</label>
            <select id="mainProduct" name="mainProduct">
                <?php while ($row = mysqli_fetch_assoc($result_main_products)): ?>
                    <option value="<?php echo $row['mainProduct']; ?>"><?php echo $row['mainProduct']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="grams">Grams:</label>
            <input type="text" id="grams" name="grams">
        </div>
        <button type="submit">Search</button>
    </form>

    <!-- Display product parts and required grams -->
    <?php if (isset($result)): ?>
        <table>
            <tr>
                <th>Product Part</th>
                <th>Required Grams</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['productPart']; ?></td>
                    <td><?php echo $row['requiredGrams']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

    <footer>
        <br />
        <br />
        <h2 align="center">Connect With Us</h2>
        <br />
        <br />
       
        <div class="socialMedia">
            <div id="lo">
                <a href="https://www.facebook.com/voraabbasbhai.kaderbhai/" target="_blank"><img src="img/facebook.png" width="50px" /></a>
            </div>
            <div id="lo">
                <a href="https://www.justdial.com/Rajkot/Vora-M-Abbasbhai-Kadarbhai-Vaid-Opp-Crystal-Mall-Rajkot-City/0281PX281-X281-120725082405-I2E5_BZDET/" target="_blank"><img src="img/jd.png" width="50px" /></a>
            </div>
            <div id="lo">
                <a href="https://wa.me/919924337567" target="_blank"><img src="img/wp.jpg" width="50px" /></a>
            </div>
        </div>
        &copy; 2023-2024 Abbas Bhai Kaderbhai vaid<br />
        All Rights Reserved
    </footer>

    <script>
        function showForm() {
            var form = document.getElementById("insertForm");
            form.style.display = "block";
        }
    </script>
</body>
</html>
