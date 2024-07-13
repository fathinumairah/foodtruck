<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieFinds</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9e6e1;
            display: flex;
            min-height: 100vh;
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
            width: 150px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
        }
        thead {
            background-color: #D2D4D1;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-sm {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center py-4">ADMIN</h2>
        <a href="admin_dashboard.php">Dashboard</a>
        <div class="admin-view">
            <a href="admin_details.php">Admin Details</a>
          <!--  <a href="user_details.php">User Details</a> -->
           <!-- <a href="location_details.php">Location Details</a> -->
            <a href="index.php">List of Foods</a>
        </div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="content">
        <div class="container my-5">
            <img src="logo.jpg" alt="FoodieFinds Logo" class="logo">
            <h2 class="mb-4">List of Foods</h2>
            <a class="btn btn-primary mb-3" href="/foodtruck/create.php" role="button">New Food</a>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "foodtruck";

                    // Create connection 
                    $connection = new mysqli($servername, $username, $password, $database);

                    // Check connection 
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    // Read all rows from database table
                    $sql = "SELECT * FROM clients";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    // Read data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/foodtruck/edit.php?id={$row['id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/foodtruck/delete.php?id={$row['id']}'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
