<?php
include 'connect.php';
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the login form
  
    $username = $_POST['user'];
    $password = $_POST['password'];

    // SQL query with prepared statement to retrieve the user's information
    $sql = "SELECT * FROM customer_info WHERE user=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Start a session and set session variables to indicate that the user is logged in
     
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $username; // Set the username in the session

        // Redirect to the logged-in page
        header("Location: ../Customer/loggedin_user.php");
        exit(); // Make sure to stop execution after redirecting
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kalavad</title>
    <link rel="icon" href="ak.png" />
    <link rel="stylesheet" href="part.css" />
    <link
      rel="stylesheet"
      href="https://unkg.com/boxicons@2.1.4/css/boxicons.min.css"
    />
  </head>

  <body>
    <header>
      <img src="ak.png" width="75em" />
      <h3 id="nameShop">Abbas Bhai Kaderbhai vaid</h3>
      <nav>
        <ul>
          <li><a href="..\index.php">Home</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
          <h1>Login</h1>
          <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
          <div class="input-box">
            <input type="text" placeholder="Username" name="user" required />
            <i class="bx bxs-user"></i>
          </div>
          <div class="input-box">
            <input
              type="password"
              placeholder="Password"
              name="password"
              required
            />
          </div>
          <button type="submit" class="btn">Login</button>
          <div class="register-link">
            <p>
              Don't have an account?<a href="..\Registration\reg.html"
                >Register</a
              >
            </p>
          </div>
        </form>
      </div>
    </main>
    <footer>
      <h2 align="center">Connect With Us</h2>
      <div class="socialMedia">
        <div id="lo">
          <a
            href="https://www.facebook.com/voraabbasbhai.kaderbhai/"
            target="_blank"
            ><img src="facebook.png" width="50px"
          /></a>
        </div>
        <div id="lo">
          <a
            href="https://www.justdial.com/Rajkot/Vora-M-Abbasbhai-Kadarbhai-Vaid-Opp-Crystal-Mall-Rajkot-City/0281PX281-X281-120725082405-I2E5_BZDET/"
            target="_blank"
            ><img src="jd.png" width="50px"
          /></a>
        </div>
        <div id="lo">
          <a href="https://wa.me/919924337567" target="_blank"
            ><img src="wp.jpg" width="50px"
          /></a>
        </div>
      </div>
      &copy; 2023-2024 Abbas Bhai Kaderbhai vaid<br />
      All Rights Reserved
    </footer>
    <script>
      /*         document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var username = document.getElementById('usernameInput').value;
            var password = document.getElementById('passwordInput').value;


            var usernameRegex = /^[a-zA-Z0-9]+$/;
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

            if (!username.match(usernameRegex)) {
                alert('Username must contain only alphanumeric characters.');
                return;
            }

            if (!password.match(passwordRegex)) {
                alert('Password must be between 6 to 20 characters long and contain at least one digit, one lowercase letter, and one uppercase letter.');
                return;
            }
            alert('Login successful!');
        }); */


    </script>
  </body>
</html>
