<?php
session_start();
require("conn.php");

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<a href="addmovie.php">Add Movie</a>
<br>
<a href="delete.php">Delete Users</a>
<br>
<a href="search.php">Search</a>
</body>
</html>
