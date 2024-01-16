<?php
session_start();
require("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    if ($result && mysqli_num_rows($result) > 0) {
        // Check the password using password_verify
        if ($password == $data['password']) {
            $_SESSION['username'] = $username;

            if ($username === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: homepage.php');
            }
            exit;
        } else {
            echo "Invalid Password";
        }
    } else {
        echo "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">SIGN IN</button>
        <br>
    </form>
</body>
</html>
