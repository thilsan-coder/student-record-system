<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
if ($conn->query($sql)) {
    echo "Registered successfully! <a href='login.html'>Login here</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
