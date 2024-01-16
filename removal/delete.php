<?php
session_start();
require("conn.php");

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_selected'])) {
    $selectedUsers = isset($_POST['selected_users']) ? $_POST['selected_users'] : [];

    if (empty($selectedUsers)) {
        echo "No users selected for deletion.";
    } else {
        $deleteQuery = "DELETE FROM users WHERE username IN (?" . str_repeat(", ?", count($selectedUsers) - 1) . ")";
        $stmt = mysqli_prepare($conn, $deleteQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($selectedUsers)), ...$selectedUsers);
            $deleteResult = mysqli_stmt_execute($stmt);
            if ($deleteResult) {
                echo "Selected users deleted successfully!";
            } else {
                echo "Error deleting users: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - Delete Users</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <form method="post" action="">
        <table border=".5">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><input type="checkbox" name="selected_users[]" value="<?php echo $row['username']; ?>"></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br>
        <button type="submit" name="delete_selected">Delete Selected Users</button>
    </form>
</body>
</html>
