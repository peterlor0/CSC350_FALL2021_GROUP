<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared/shared.php" ?>

<html>

<head>
    <title>Submit Schedule</title>
    <link rel="stylesheet" href="/shared/shared.css">
    <link rel="stylesheet" href="submit.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <?php

    session_start();
    checkLoginState();

    if (isset($_POST['slot'])) {
        $conn = startSQLConnect();

        $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_SESSION['username']}'";
        $query = $conn->query($sql);
        $row = mysqli_fetch_assoc($query);

        echoNavBar($_SESSION['username'], $row['RoomNum']);

    ?>
        <div class="container">

            <?php

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
                    $tmp = date("M d, Y, l, h:i A", strtotime($_POST['slot'])) . " - " . date("h:i A", strtotime($_POST['slot']) + 3600 * 3 - 1);

                    echo "<p>Succeeded</p>";
                    echo "<p>Your Schedule: {$tmp} </p>";
                } else {
                    echo "Error: Other user selected this slot already. Please select another one instead.<br>";
                }

                $conn->close();
            }

            ?>

            <a href="../main page/main.php">Continue</a>
        </div>

    <?php
    } else {
        redirectPageTo("/main page/main.php");
    }

    ?>


</body>

</html>