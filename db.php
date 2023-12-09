
<?php
$servername = "172.31.22.43";
$username = "Vinayak200549292";
$password = "ewbAg3_AQ9";
$database = "Vinayak200549292";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

