<?php
include 'db.php';

// store registration message
$registrationMessage = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the entered username from the form
    $username = $_POST['username'];

    // Hash password 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // insert query 
    $sql = "INSERT INTO loginpage (username, password) VALUES ('$username', '$password')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        //success message
        $registrationMessage = "You are registered successfully! Please login using the login button below.";
    } else {
        // Display error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="register">
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Register</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">User Authenication</a>
                <div class="collapse navbar-collapse pad" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
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
        <h2>Register</h2>

        <?php if (!empty($registrationMessage)) { ?>
            <!-- Display the registration message -->
            <p><?php echo $registrationMessage; ?></p>
        <?php } ?>

        <form action="register.php" method="post">>

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <input  class="butn" type="submit" value="Register">
        </form>

        <!-- connect to the login page -->
        <p>Click to login <a href="index.php">Login</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>