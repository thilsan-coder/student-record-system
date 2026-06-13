<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: manage_students.php");
}

// Pagination setup
$limit = 5;  // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $conn->query("INSERT INTO students (name, email, course, year) VALUES ('$name', '$email', '$course', '$year')");
    header("Location: manage_students.php");
}

// Fetch records
$result = $conn->query("SELECT * FROM students");

// Fetch records with pagination
$result = $conn->query("SELECT * FROM students LIMIT $limit OFFSET $offset");
$total = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'];
$totalPages = ceil($total / $limit);

?>



<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f7f7f7; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        input, select { padding: 8px; width: 100%; margin-bottom: 10px; }
        form { margin-bottom: 20px; }
        button, a.btn {
            padding: 10px 15px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
        }
        a.btn-delete { background: crimson; }
        body { font-family: Arial; padding: 30px; background: #f7f7f7; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            text-decoration: none;
            background: #007BFF;
            color: white;
            border-radius: 5px;
        }
        .pagination a.active {
            background: #0056b3;
        }
    </style>
</head>
<body>
    
    <h2>Admin - Manage Students</h2>
    <a href="admin_dashboard.php" class="btn">← Back to Dashboard</a>
    <br><br>
    <form method="POST">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="year" placeholder="Year (e.g., 1st Year)" required>
        <button type="submit" name="add">Add Student</button>
    </form>

    <form id="searchForm" onkeyup="searchStudents()">
    <input type="text" id="searchInput" placeholder="Search students..." style="width: 100%; padding: 10px; margin-bottom: 20px;">
    </form>


    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Year</th><th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['course'] ?></td>
            <td><?= $row['year'] ?></td>
            <td>
            <a href="?delete=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this student?')">Delete</a>
            <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i' class='" . ($i == $page ? 'active' : '') . "'>$i</a>";
        }
        ?>
    </div>

    <script>
function searchStudents() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    table = document.querySelector('table');
    tr = table.getElementsByTagName('tr');
    
    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName('td');
        let match = false;
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    match = true;
                }
            }
        }
        tr[i].style.display = match ? '' : 'none';
    }
}
</script>

</body>
</html>
