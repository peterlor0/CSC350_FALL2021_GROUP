<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
    <link rel="stylesheet" href="schedule.css">
</head>

<body>
    <?php 
        session_start();
        checkLoginState();
    ?>

    <p><h1>Select a slot:</h1></p>
    <ul>
        <li><label><input type="radio" name="slot" value="1">1</label></li>
        <li><label><input type="radio" name="slot" value="2">2</label></li>
        <li><label><input type="radio" name="slot" value="3">3</label></li>
        <li><label><input type="radio" name="slot" value="4">4</label></li>
    </ul>

    <p><button>Submit</button></p>
    <p><a href="../main page/main.php"><button>Ok, I Give Up</button></a></p>
    
</body>

</html>