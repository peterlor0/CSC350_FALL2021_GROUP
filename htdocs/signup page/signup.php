<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<html>

<head>
    <title>SignUp</title>
    <link rel="stylesheet" href="./../shared.css">
    <link rel="stylesheet" href="./signup.css">
    <script src="./signup.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['roomnum'])) {
        $conn = startSQLConnect();

        $flag_succeed = false;

        //check username
        $sql = "SELECT * FROM mgr.userdata WHERE Username = '{$_POST['username']}'";
        $query = $conn->query($sql);

        if ($query && $query->num_rows > 0) {
            $flag_username = false;
        } else {
            $flag_username = true;
        }

        //check room num
        $sql = "SELECT * FROM mgr.userdata WHERE RoomNum = '{$_POST['roomnum']}'";
        $query = $conn->query($sql);

        if ($query && $query->num_rows > 0) {
            $flag_roomnum = false;
        } else {
            $flag_roomnum = true;
        }

        if ($flag_username && $flag_roomnum) {
            $sql = "INSERT INTO mgr.userdata (Username, Password, RoomNum)
            VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['roomnum']}')";

            if ($conn->query($sql) === TRUE) {
                $flag_succeed = true;
            }
        }

        $conn->close();
    }

    if (isset($flag_succeed) && $flag_succeed) {
    ?>
        <div class="container">
            <?php
            echo "<p>Account '{$_POST['username']}' Created Successfully</p><br>";
            echo "<a href='../index.php'>Continue to login</a>";

            ?>
        </div>
    <?php
    } else {
    ?>
        <div class="container">
            <h1>SignUp</h1>
            <?php
            if (isset($flag_succeed)) {
                echo "<p class='err'>Could not create account</p>";
            }
            ?>
            <form method="post" onsubmit="return submitCheck()">
                <table class="center">
                    <tr>
                        <td style="vertical-align: top;">
                            <ion-icon name="person-outline"></ion-icon>
                            <label>Username:</label>
                        </td>
                        <td>
                            <?php
                            if (isset($flag_succeed)) {
                                echo "<input id='username' type='text' name='username' value='{$_POST['username']}' required>";
                            } else {
                                echo "<input id='username' type='text' name='username' required>";
                            }

                            if (isset($flag_username) && !$flag_username) {
                                echo "<p class='err left' id='username_alert'>Username already in use</p>";
                            }else{
                                echo "<p class='err left' id='username_alert'></p>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <label>Password:</label>
                        </td>
                        <td>
                            <input id="password" type="password" name="password" required>
                            <p class="err left" id="password_alert"></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">
                            <ion-icon name="home-outline"></ion-icon>
                            <label>Room:</label>
                        </td>
                        <td>
                            <?php
                            if (isset($flag_succeed)) {
                                echo "<input id='roomnum' type='text' name='roomnum' value='{$_POST['roomnum']}' required>";
                            } else {
                                echo "<input id='roomnum' type='text' name='roomnum' required>";
                            }

                            if (isset($flag_roomnum) && !$flag_roomnum) {
                                echo "<p class='err left' id='roomnum_alert'>Room Number already in use</p>";
                            }else{
                                echo "<p class='err left' id='roomnum_alert'></p>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Submit" style="width: 100%;">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="../index.php">
                                <ion-icon name="chevron-back-outline"></ion-icon>Back
                            </a>
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    <?php
    }

    ?>

</body>

</html>