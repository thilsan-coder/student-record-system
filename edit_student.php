<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

if (!isset($_GET['id'])) {
    die("Student ID is required.");
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    
    $conn->query("UPDATE students SET name='$name', email='$email', course='$course', year='$year' WHERE id=$id");
    header("Location: manage_students.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f7f7f7; }
        .form-container {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        input, select {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        button {
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Student Details</h2>
        <form method="POST">
            <input type="text" name="name" value="<?= $student['name'] ?>" required>
            <input type="email" name="email" value="<?= $student['email'] ?>" required>
            <input type="text" name="course" value="<?= $student['course'] ?>" required>
            <input type="text" name="year" value="<?= $student['year'] ?>" required>
            <button type="submit">Save Changes</button>
        </form>
        <a href="manage_students.php">← Back to Manage Students</a>
    </div>
</body>
</html>
