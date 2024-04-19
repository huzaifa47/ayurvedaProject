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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateProductLoc'])) {
      
        $productLoc = $_POST['updateProductLoc'];
        $newStock = $_POST['newStock'];

        $updateSql = "UPDATE productstock SET stock=? WHERE productLoc=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('ds', $newStock, $productLoc);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
       
        $productname = $_POST['productname'];
        $productLoc = $_POST['productLoc'];
        $date = $_POST['date'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO productstock (productname, productLoc, date, stock) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssd', $productname, $productLoc, $date, $stock);
        $stmt->execute();

 
        $stmt->close();
    }
}

$sql = "SELECT * FROM productstock";
$result = $conn->query($sql);
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

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="admin_login.css">
</head>

<body bgcolor="#eeff90">
    <header>
        <img src="img/ak.png" width="75em" />
        <h3 id="nameShop">Abbas Bhai Kaderbhai vaid</h3>

        <nav>
            <ul>
                <li><a href="admin_query.php">All Queries</a></li>
                <li><a href="admin_mix.php">All Mixtures</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div style="height: 100px; ;"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>

    <!-- Insert new data form -->
    <button onclick="showInsertForm()">Insert New</button>
    <button onclick="showUpdateForm()">Update</button>
    <form id="insertForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
        style="display: none;">
        <label for="productname">Product Name:</label>
        <input type="text" id="productname" name="productname" required><br><br>
        <label for="productLoc">Product Location:</label>
        <input type="text" id="productLoc" name="productLoc" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br><br>
        <input type="submit" value="Insert">
    </form>

    <form id="updateForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
        style="display: none;">
        <label for="updateProductLoc">Product Location:</label>
        <input type="text" id="updateProductLoc" name="updateProductLoc" required><br><br>
        <label for="newStock">New Stock:</label>
        <input type="number" id="newStock" name="newStock"><br><br>
        <input type="submit" value="Update">
    </form>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Location</th>
                <th>Date</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any rows returned by the query
            if ($result->num_rows > 0) {
                // Loop through each row and display data in table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['productname'] . "</td>";
                    echo "<td>" . $row['productLoc'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['stock'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <br />
        <br />
        <h2 align="center">Connect With Us</h2>
        <br />
        <br />
        <div class="socialMedia">
            <div id="lo">
                <a href="https://www.facebook.com/voraabbasbhai.kaderbhai/" target="_blank"><img src="img/facebook.png"
                        width="50px" /></a>
            </div>
            <div id="lo">
                <a href="https://www.justdial.com/Rajkot/Vora-M-Abbasbhai-Kadarbhai-Vaid-Opp-Crystal-Mall-Rajkot-City/0281PX281-X281-120725082405-I2E5_BZDET/"
                    target="_blank"><img src="img/jd.png" width="50px" /></a>
            </div>
            <div id="lo">
                <a href="https://wa.me/919924337567" target="_blank"><img src="img/wp.jpg" width="50px" /></a>
            </div>
        </div>
        &copy; 2023-2024 Abbas Bhai Kaderbhai vaid<br />
        All Rights Reserved
    </footer>

    <script>
        window.onload = function () {
            if (document.cookie.indexOf('session_check') === -1) {
            
                window.location.href = 'logout.php';
            }
        };

        function showInsertForm() {
            var insertForm = document.getElementById("insertForm");
            var updateForm = document.getElementById("updateForm");
            insertForm.style.display = "block";
            updateForm.style.display = "none";
        }

        function showUpdateForm() {
            var insertForm = document.getElementById("insertForm");
            var updateForm = document.getElementById("updateForm");
            insertForm.style.display = "none";
            updateForm.style.display = "block";
        }
    </script>
</body>

</html>

<?php

$conn->close();
?>
