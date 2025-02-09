



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stellar Shine</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./loginstyle.css" />
  </head>
  <body>
    <div class="container">
       <form method="post" action="login.php">
        <h1>Login</h1>

        <div class="input-box">
          <input type="text" placeholder="username" name="username" required />
          <!-- <i class="bx bxs-user"></i> -->
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" name="password" required />
          <!-- <i class="bx bxs-lock-alt"></i> -->
        </div>
        
        <button type="submit" class="btn">Login</button>

        <div class="register-link" >
         <p> Don't have an account? <a href="#" > <strong>Register here! </strong></a></p>
        </div>
      </form>
    </div>
  </body>
</html>
<?php
// Start the session
session_start();

// Assuming you have a MySQL connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "housekeeping";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Protect against SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if username and password match
    $sql = "SELECT * FROM user WHERE UID='$username' AND PASS='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Valid login
        $_SESSION['username'] = $username;
        header("Location: index.html"); // Redirect to a welcome page
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

// Close the database connection
$conn->close();
?>
