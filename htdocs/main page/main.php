<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
</head>

<body style="text-align: center;">
    <?php
    session_start();
    checkLoginState();

    $conn = startSQLConnect();
    $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_SESSION['username']}'";
    $query = $conn->query($sql);
    $row = mysqli_fetch_row($query);
    echo "<h1>Welcome back! {$_SESSION['username']}</h1>";
    echo "<p>Room Number: {$row[2]}</p>";


    //this week

    $date = getDateTimeRangeOfThisWeekSchedule();
    $sql = "SELECT Date FROM mgr.schedule WHERE Date >= '{$date['start']}' AND Date < '{$date['end']}' AND Username = '{$_SESSION['username']}'";
    $query = $conn->query($sql);

    echo "<h2>This Week ({$date['start']} - {$date['end']}):</h2>";

    if ($query && $query->num_rows > 0) {
        $ret = mysqli_fetch_assoc($query);
        $tm = strtotime($ret['Date']);

        echo "Your schedule: " . date("Y-m-d, l, h:i A", $tm) . " - " . date("h:i A", $tm + 3600 * 3 - 1) . "<br>";
    } else {
    ?>
        <a href="../schedule page/schedule.php?thisweek=1">Schedule...</a><br><br>
        <?php
    }

    //next week
    if (isAvailableForNextWeekSchedule()) {
        $date = getDateTimeRangeOfNextWeekSchedule();
        $sql = "SELECT Date FROM mgr.schedule WHERE Date >= '{$date['start']}' AND Date < '{$date['end']}' AND Username = '{$_SESSION['username']}'";
        $query = $conn->query($sql);

        echo "<h2>Next Week ({$date['start']} - {$date['end']}):</h2>";

        if ($query && $query->num_rows > 0) {
            $ret = mysqli_fetch_assoc($query);
            $tm = strtotime($ret['Date']);

            echo "Your schedule: " . date("Y-m-d, l, h:i A", $tm) . " - " . date("h:i A", $tm + 3600 * 3 - 1) . "<br>";
        } else {
        ?>
            <a href="../schedule page/schedule.php?thisweek=0">Schedule...</a><br><br>
    <?php
        }
    }

    echo "<a href='logout.php'>Logout</a><br>";
    $conn->close();

    ?>
</body>

</html>