<?php
include 'db.php';

// Start a new session
session_start();

// Variable to store login message
$loginMessage = '';

// the POST method used here to submmit data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Query to select data from database
    $sql = "SELECT * FROM loginpage WHERE username=?";
    
    // Prepare the SQL query to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    // save result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If user is found in the database
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $loginSuccess = true; //successful login
        } else {
            // error message(login error)
            $loginMessage = "Incorrect password!";
        }
    } else {
        // an error message
        $loginMessage = "User not found! Please register.";
    }
}

// Close connection with database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="login">
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">User Authenication</a>
                <div class="collapse navbar-collapse pad" id="navbarNav">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>

    <div class="container">
        <?php if (isset($loginSuccess) && $loginSuccess) { ?>
            <!-- Displaying welcome content-->
            <h2>Login Success</h2>
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
            <p>page is only visible after login.</p>
        <?php } else { ?>
            <!-- Showing login form if not logged in -->
            <h2>Login</h2>

            <?php if (!empty($loginMessage)) { ?>
                <!-- Displaying error message if login failed -->
                <p><?php echo $loginMessage; ?></p>
            <?php } ?>

            <form action="" method="post">
                <!-- Login form -->
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <input class="butn" type="submit" value="Login">
            </form>

            <!-- Link to registration page-->
            <p> lick to register. <a href="register.php">Register here</a></p>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>