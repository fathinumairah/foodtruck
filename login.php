<?php
session_start();

// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "foodtruck"; // Update to the correct database name

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = $connection->real_escape_string($username);
    $password = $connection->real_escape_string($password);

    // Check credentials (Assuming you have a users table with username and password columns)
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
