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

    <p>
    <h1>Select a slot:</h1>
    </p>
    <div class="slotList">
        <ul>
            <?php
            $slots = generateSlotsByRange(getNextSlotDateTime(), date("Y-m-d", strtotime("this week + 7 day")) . " 0:00:00");

            $day = "";

            foreach ($slots as &$i) {
                $day2 = date("d", strtotime($i));

                if ($day != $day2) {
                    echo "<hr>";
                }

                $output = date("Y-m-d, l, H:i", strtotime($i)) . " - " . date("H:i", strtotime($i) + 3600 * 3);

                echo "<li><label><input type='radio' name='slot' value='{$output}'>{$output}</label></li>";

                $day = $day2;
            }

            ?>
        </ul>
    </div>
    <p><button>Submit</button></p>
    <p><a href="../main page/main.php"><button>Ok, I Give Up</button></a></p>

</body>

</html>