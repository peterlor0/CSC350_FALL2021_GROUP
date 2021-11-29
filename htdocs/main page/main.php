<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php"?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        echo "welcome back! " . $_SESSION['username'];
    } else {
        echo "error";
    }
    ?>
</body>

</html>