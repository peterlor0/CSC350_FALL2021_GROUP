<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        $conn = startSQLConnect();
        $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_SESSION['username']}'";
        $ret = $conn->query($sql);
        $row = mysqli_fetch_row($ret);
        echo "welcome back! " . $_SESSION['username'] . "<br>";
        echo "Room Number: " . $row[2] . "<br>";
        echo "<a href='logout.php'>Log out</a>";
    } else {
        echo "error";
    }
    ?>
</body>

</html>