<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost"; // Update with your server name
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "foodtruck"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get count from a table
function getCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) as count FROM $table");
    if ($result) {
        return $result->fetch_assoc()['count'];
    } else {
        echo "Error executing query for table $table: " . $conn->error;
        return 0;
    }
}

// Fetch total counts
$adminCount = getCount($conn, 'admin');
$usersCount = getCount($conn, 'users');
$clientsCount = getCount($conn, 'clients');

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: url('bg1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 200px;
            height: auto;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #8DA7A8;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">ADMIN</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <div class="admin-view">
            <a href="admin_details.php">Admin Details</a>
            <a href="user_details.php">User Details</a>
            <a href="location_details.php">Location Details</a>
            <a href="index.php">List of Foods</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="content">
        <img src="logo.jpg" alt="Logo" class="logo">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        TOTAL REGISTERED ADMIN
                    </div>
                    <div class="card-body text-center">
                        <h1><?php echo $adminCount; ?></h1>
                        <p>Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        TOTAL REGISTERED USERS
                    </div>
                    <div class="card-body text-center">
                        <h1><?php echo $usersCount; ?></h1>
                        <p>Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        LIST OF FOODS
                    </div>
                    <div class="card-body text-center">
                        <h1><?php echo $clientsCount; ?></h1>
                        <p>Foods</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
