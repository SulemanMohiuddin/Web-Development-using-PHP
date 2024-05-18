<?php
// Start or resume a session
session_start();

// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "project"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if the session is expired
function isSessionExpired() {
    $session_expiration = 300; // 5 minutes in seconds
    $current_time = time();
    if (isset($_SESSION['last_activity']) && ($current_time - $_SESSION['last_activity']) > $session_expiration) {
        // Session expired, destroy the session and return true
        session_unset();
        session_destroy();
        return true;
    } else {
        // Update last activity time
        $_SESSION['last_activity'] = $current_time;
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered ID and password
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare a SELECT statement to check if the credentials are correct
    $sql = "SELECT * FROM users WHERE id = '$id' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows == 1) {
        // User exists, fetch user data
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['username'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['profile_pic'] = $user['profile_pic'];

        // Redirect to main page based on role
        switch ($user['role']) {
            case 'student':
                header("Location: main.php"); // Redirect to student dashboard
                exit();
                break;
            case 'faculty':
                header("Location: main.php"); // Redirect to faculty dashboard
                exit();
                break;
            case 'admin':
                header("Location: main.php"); // Redirect to admin dashboard
                exit();
                break;
        }
    } else {
        // Display error message if user does not exist
        $error_message = "Invalid ID or password";
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
        body {
  background-color: transparent;
  background-image: url("https://cdn.pixabay.com/photo/2016/06/02/02/33/triangles-1430105_960_720.png");
   background-size: cover;
}

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
  background-color: transparent;
  border-radius: 10px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}


.form {
  position: relative;
  z-index: 1;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.7);
  border-radius: 20px;
}

.form input[type="text"],
.form input[type="password"] {
  font-family: 'Roboto', sans-serif;
  outline: none;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
  border-radius: 20px;
  background-color: rgba(255, 255, 255, 0.7);
}

.form button {
  font-family: 'Roboto', sans-serif;
  text-transform: uppercase;
  outline: none;
  background-color: #2196F3;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
  cursor: pointer;
  border-radius: 20px;
}

.form button:hover,
.form button:active,
.form button:focus {
  background-color: #1976D2;
}

.form h2 {
  color: #333333;
  font-size: 28px;
  margin: 0 0 30px;
}

.form p.message {
  color: #666666;
  font-size: 14px;
  margin-top: 15px;
}

.form p.message a {
  color: #2196F3;
  text-decoration: none;
}

.form p.message a:hover {
  text-decoration: underline;
}

    </style>

</head>

<body>
  
    <div class="login-page">
        <div class="form">
            <h2>Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="id" placeholder="ID">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Log in</button>
            </form>
        </div>
    </div>
</body>
</html>
