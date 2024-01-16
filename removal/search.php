<?php
session_start();
require("conn.php");

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$query = "SELECT m.title AS MovieTitle, m.genre AS Genre, a.Lastname AS ActorLastname, a.Firstname AS ActorFirstname, d.Lastname AS DirectorLastname, d.Firstname AS DirectorFirstname, ma.role AS Role
          FROM movie_actedin ma
          JOIN movie m ON ma.mno = m.mno
          JOIN actor a ON ma.actorNo = a.actorID
          JOIN director d ON ma.dirID = d.dirID";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter'])) {
    $inputValue = mysqli_real_escape_string($conn, $_POST['search_input']);
    $filterByTitle = isset($_POST['filter_title']);
    $filterByActor = isset($_POST['filter_actor']);

    $titleFilter = $filterByTitle ? " AND m.title LIKE '%$inputValue%'" : '';
    $actorFilter = $filterByActor ? " AND CONCAT(a.Firstname, ' ', a.Lastname) LIKE '%$inputValue%'" : '';

    $query = "SELECT m.title AS MovieTitle, m.genre AS Genre, a.Lastname AS ActorLastname, a.Firstname AS ActorFirstname, d.Lastname AS DirectorLastname, d.Firstname AS DirectorFirstname, ma.role AS Role
              FROM movie_actedin ma
              JOIN movie m ON ma.mno = m.mno
              JOIN actor a ON ma.actorNo = a.actorID
              JOIN director d ON ma.dirID = d.dirID
              WHERE 1 $titleFilter $actorFilter";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error fetching data: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEARCH</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<h2>Movie and Actor Information</h2>

<form method="post" action="">
    <label>
        Filter by Movie Title:
        <input type="checkbox" name="filter_title" value="1">
    </label>
    <label>
        Filter by Actor:
        <input type="checkbox" name="filter_actor" value="1">
    </label>
    <input type="text" name="search_input" placeholder="Enter search term" required>
    <br>
    <button type="submit" name="filter">Filter Data</button>
</form>

<table>
    <thead>
    <tr>
        <th>Movie Title</th>
        <th>Genre</th>
        <th>Actor Lastname</th>
        <th>Actor Firstname</th>
        <th>Director Lastname</th>
        <th>Director Firstname</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($result)) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['MovieTitle']; ?></td>
                <td><?php echo $row['Genre']; ?></td>
                <td><?php echo $row['ActorLastname']; ?></td>
                <td><?php echo $row['ActorFirstname']; ?></td>
                <td><?php echo $row['DirectorLastname']; ?></td>
                <td><?php echo $row['DirectorFirstname']; ?></td>
                <td><?php echo $row['Role']; ?></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
