<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 50px;
            text-align: center;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Welcome User, <?= $_SESSION['name'] ?></h1>
    <a href="user_profile.php">View Profile</a>
    <a href="logout.php">Logout</a>
</body>
</html>
