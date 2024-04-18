<?php

session_start();

if (isset($_SESSION['username'])) {
    $username1 = $_SESSION['username'];
} else {
    header("Location: admin_login.html");
    exit();
}

setcookie('session_check', 'session_active', time() + 60, '/'); // Adjust the lifetime as needed (e.g., 60 seconds)

$username1 = $_SESSION['username'];

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if (isset($_POST['srnum']) && isset($_POST['answer'])) {
  
        $srnum = mysqli_real_escape_string($conn, $_POST['srnum']);
        $answer = mysqli_real_escape_string($conn, $_POST['answer']);

        // Update query
        $update_query = "UPDATE querycus SET ans = '$answer' WHERE srNum = '$srnum'";
        if (mysqli_query($conn, $update_query)) {
            echo "Answer added successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
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
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 4px;
            margin-bottom: 4px;
            resize: vertical;
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
                 <li><a href="loggedin.php">Inventory</a></li>
                <li><a href="admin_mix.php">All Mixtures</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div style="height: 100px; ;"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Sr. Num</th>
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
            <?php
            $query = "SELECT * FROM querycus";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }

            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['srNum']); ?></td>
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

    <button onclick="showForm()">Add Answers</button>

    <div id="insertForm" style="display: none;">
        <h2>Add Answers</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="srnum">Sr. Num:</label>
                <input type="text" id="srnum" name="srnum" required>
            </div>
            <div class="form-group">
                <label for="answer">Answer:</label>
                <textarea id="answer" name="answer" rows="4" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

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
