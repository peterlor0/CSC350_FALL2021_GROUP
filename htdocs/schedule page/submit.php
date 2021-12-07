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

    if (isset($_POST['slot'])) {
        $conn = startSQLConnect();

        $sql = "INSERT INTO mgr.schedule (Date, Username)
        VALUES ('{$_POST['slot']}', '{$_SESSION['username']}')";

        if ($conn->query($sql) === TRUE) {
            echo "Successd <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }else{
        redirectPageTo("/main page/main.php");
    }

    ?>

    <a href="../main page/main.php">Continue</a>
</body>

</html>