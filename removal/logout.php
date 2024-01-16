<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Logout</h1>
    <?php
        session_start();
        session_destroy();
    ?>

    <p>You have been successfully logged out.</p>
    <p>Redirecting to login page...</p>

    <?php header("Refresh: 2, url=login.php"); ?>
</body>
</html>