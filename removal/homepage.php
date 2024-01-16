<?php
session_start();

require("conn.php");

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Location: logout.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteUsername = $_POST['delete_username'];
    $deletePassword = $_POST['delete_password'];

    $query = "SELECT * FROM users WHERE username = '$deleteUsername'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $deleteQuery = "DELETE FROM users WHERE username = '$deleteUsername'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid credentials for deletion.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
</head>
<body>
    <form method="post" action="">
        <button type="submit" name="logout">LOG OUT</button>
    </form>

    <h2>Delete User</h2>
    <form method="post" action="">
        <label for="delete_username">Username:</label>
        <input type="text" id="delete_username" name="delete_username" required>
        <br>

        <label for="delete_password">Password:</label>
        <input type="password" id="delete_password" name="delete_password" required>
        <br>

        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this user?');">DELETE USER</button>
    </form>
</body>
</html>
