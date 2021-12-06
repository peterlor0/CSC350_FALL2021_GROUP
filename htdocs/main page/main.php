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
    checkLoginState();

    $conn = startSQLConnect();
    $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_SESSION['username']}'";
    $ret = $conn->query($sql);
    $row = mysqli_fetch_row($ret);
    echo "welcome back! " . $_SESSION['username'] . "<br>";
    echo "Room Number: " . $row[2] . "<br>";
    echo "<a href='logout.php'>Log out</a>";
    $conn->close();
    ?>
    <a href="../schedule page/schedule.html">Schedule...</a>
    <?php
    ?>
</body>

</html>