<?php
session_start();
require("conn.php");

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $mno = $_POST['mno'];

    $insertQuery = "INSERT INTO movie (mno, title, genre) VALUES ('$mno', '$title', '$genre')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo "Movie added successfully!";
    } else {
        echo "Error adding movie: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - Add Movie</title>
</head>
<body>
    <h2>Add Movie</h2>
    <form method="post" action="">
        <label for="mno">Movie No:</label>
        <input type="text" id="mno" name="mno" required>
        <br>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>

        <label for="genre">Genre:</label>
        <select id="genre" name="genre" required>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Comedy">Comedy</option>
            <option value="Drama">Drama</option>
        </select>
        <br>
        <button type="submit" name="add_movie">ADD MOVIE</button>
    </form>
</body>
</html>
