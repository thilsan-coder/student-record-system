<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'] ?? '';
$name = $_SESSION['name'] ?? 'Unknown';

$user = null;
if (!empty($email)) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_password'])) {
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    if ($stmt->execute()) {
        $message = "Password updated successfully!";
    } else {
        $message = "Error updating password!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e4f5);
            padding: 60px;
        }
        .profile {
            width: 400px;
            background: #fff;
            padding: 30px;
            margin: auto;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .success {
            color: green;
            text-align: center;
            margin: 10px 0;
        }
        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="profile">
        <h2>User Profile</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Email:</strong> <?= $user ? htmlspecialchars($user['email']) : 'Email not found' ?></p>

        <h3>Change Password</h3>
        <?php if (isset($message)) echo "<p class='success'>$message</p>"; ?>
        <form method="POST">
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit">Update Password</button>
        </form>
        <a href="user_dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>
