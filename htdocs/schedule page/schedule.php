<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
    <link rel="stylesheet" href="schedule.css">
    <script src="./schedule.js"></script>
</head>

<body>
    <?php
    session_start();
    checkLoginState();

    $conn = startSQLConnect();

    //check if user has scheduled
    if (isUserAlreadyScheduleThisWeek($conn, $_SESSION['username'])) {
        redirectPageTo("/main page/main.php");
    } else {
        echo "<h1>Username: {$_SESSION['username']}</h1>";

        $date = getDateTimeRangeOfThisWeekSchedule();

        $fullSlotsList = generateSlotsByRange(getNextSlotDateTime(), $date['end']);

        $sql = "SELECT Date FROM mgr.schedule WHERE Date >= '{$date['start']}' AND Date < '{$date['end']}'";
        $query = $conn->query($sql);

        $slotsAlreadySchedule = array();

        while ($ret = mysqli_fetch_assoc($query)) {
            array_push($slotsAlreadySchedule, $ret['Date']);
        }

        //all slots - already schedule slots = available slots
        $slotsAvailable = diffDateTimeList($fullSlotsList, $slotsAlreadySchedule);

    ?>
        <p>
        <h2>Select a slot:</h2>
        </p>
        <form action="./submit.php" method="post">
            <div class="slotList center">
                <ul>
                    <?php
                    $day = "";

                    foreach ($slotsAvailable as &$i) {
                        $day2 = date("d", strtotime($i));

                        if ($day != $day2) {
                            echo "<hr>";
                            $tmp = date("Y-m-d, l", strtotime($i));
                            echo "<p class='dateTitle'>{$tmp}</p>";
                        }

                        $output = date("h:i A", strtotime($i)) . " - " . date("h:i A", strtotime($i) + 3600 * 3 - 1);

                        echo "<li><label><input type='radio' name='slot' onclick='onClick(this)' value='{$i}'>{$output}</label></li>";

                        $day = $day2;
                    }

                    ?>
                </ul>

            </div>
            <p>Your Selection: <span id="selection" class="selection">None</span></p>
            <p>
                <input id="submit" type="submit" value="Submit" disabled>
                <a href="../main page/main.php"><button type="button">Ok, I Give Up</button></a>
            </p>
        </form>
        


    <?php

    }

    $conn->close();

    ?>


</body>

</html>