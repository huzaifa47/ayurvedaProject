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
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
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
        .answer-form {
            display: none;
        }
        .button-container {
    text-align: center;
    margin-bottom: 20px; /* Add some margin below the buttons */
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
                <li><a href="loggedin.php">Inventory</a></li>
                <li><a href="admin_mix.php">All Mixtures</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div style="height: 100px; ;"></div>
    <h1>Welcome, <?php echo htmlspecialchars($username1); ?>!</h1>
    
    <table border="1" id="queryTable">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM querycus where ans='Not Answered' ";
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
                    <td>
                        <button onclick="showAnswerForm(<?php echo $row['srNum']; ?>)">Add Answer</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div id="insertForm" class="answer-form">
        <h2>Add Answer</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="answer">Answer:</label>
                <textarea id="answer" name="answer" rows="4" required></textarea>
            </div>
            <input type="hidden" id="srnum" name="srnum">
            <button type="submit">Add</button>
        </form>
    </div>
    <div class="button-container">
    <button onclick="addAllQueries()">Add All Queries</button>
    <button onclick="showNonAnswered()">Show Non-Answered Queries</button>
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
    function showAnswerForm(srNum) {
        var form = document.getElementById("insertForm");
        var srNumField = document.getElementById("srnum");
        form.style.display = "block";
        srNumField.value = srNum;
    }

    function addAllQueries() {
        var tableBody = document.querySelector("#queryTable tbody");

        // Fetch all queries via AJAX
        fetch("getAll.php")
            .then(response => response.text())
            .then(data => {
                // Append fetched queries to the table
                tableBody.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    function showNonAnsweredQueries() {
        var tableBody = document.querySelector("#queryTable tbody");

        // Fetch only non-answered queries via AJAX
        fetch("getNon.php")
            .then(response => response.text())
            .then(data => {
                // Replace table content with non-answered queries
                tableBody.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>
