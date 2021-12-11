<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
    <link rel="stylesheet" href="./submit.css">
</head>

<body>
    <?php

    session_start();
    checkLoginState();

    if (isset($_POST['slot'])) {
        $conn = startSQLConnect();

        $dateOfThisWeek = getDateTimeRangeOfThisWeekSchedule();
        $dateOfNextWeek = getDateTimeRangeOfNextWeekSchedule();
        $dateOfSelection = $_POST['slot'];

        $flag = false;

        if (isDateTimeInRange($dateOfSelection, getNextSlotDateTime(), $dateOfThisWeek['end'])) {
            if (isUserAlreadyScheduleThisWeek($conn, $_SESSION['username'])) {
                echo "error: already scheduled this week<br>";
            } else {
                $flag = true;
            }
        } else if (isDateTimeInRange($dateOfSelection, $dateOfNextWeek['start'], $dateOfNextWeek['end'])) {
            if (isAvailableForNextWeekSchedule()) {
                if (isUserAlreadyScheduleNextWeek($conn, $_SESSION['username'])) {
                    echo "error: already scheduled next week<br>";
                } else {
                    $flag = true;
                }
            } else {
                echo "error: next week schedule not available<br>";
            }
        } else {
            echo "error: selection error<br>";
        }


        if ($flag) {
            $sql = "INSERT INTO mgr.schedule (Date, Username)
        VALUES ('{$_POST['slot']}', '{$_SESSION['username']}')";

            if ($conn->query($sql) === TRUE) {
                echo "Succeeded<br>";
            } else {
                echo "Error: Other user selected this slot already. Please select another one instead.<br>";
            }

            $conn->close();
        }
    } else {
        redirectPageTo("/main page/main.php");
    }

    ?>

    <a href="../main page/main.php">Continue</a>
</body>

</html>