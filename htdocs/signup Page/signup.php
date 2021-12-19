<!DOCTYPE html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared/shared.php" ?>

<html>

<head>
    <title>SignUp</title>
    <link rel="stylesheet" href="/shared/shared.css">
    <link rel="stylesheet" href="signup.css">
    <script src="./signup.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['aptnum'])) {
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

        //check apt num
        $sql = "SELECT * FROM mgr.userdata WHERE AptNum = '{$_POST['aptnum']}'";
        $query = $conn->query($sql);

        if ($query && $query->num_rows > 0) {
            $flag_aptnum = false;
        } else {
            $flag_aptnum = true;
        }

        if ($flag_username && $flag_aptnum) {
            $sql = "INSERT INTO mgr.userdata (Username, Password, AptNum)
            VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['aptnum']}')";

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
            echo "<a href='../index.php'><button>Continue to login</button></a>";

            ?>
        </div>
    <?php
    } else {
    ?>
        <div class="container">
            <h2>SignUp</h2>
            <?php
            if (isset($flag_succeed)) {
                echo "<p class='err'>Could not create account</p>";
            }
            ?>
            <form method="post" onsubmit="return submitCheck()">
                <table>
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
                            } else {
                                echo "<p class='err left hide' id='username_alert'></p>";
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
                            <p class="err left hide" id="password_alert"></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top;">
                            <ion-icon name="business-outline"></ion-icon>
                            <label>Apt. Number:</label>
                        </td>
                        <td>
                            <?php
                            if (isset($flag_succeed)) {
                                echo "<input id='aptnum' type='text' name='aptnum' value='{$_POST['aptnum']}' required>";
                            } else {
                                echo "<input id='aptnum' type='text' name='aptnum' required>";
                            }

                            if (isset($flag_aptnum) && !$flag_aptnum) {
                                echo "<p class='err left' id='aptnum_alert'>Apt. Number already in use</p>";
                            } else {
                                echo "<p class='err left hide' id='aptnum_alert'></p>";
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

    <script src="/shared/autoCenter.js"></script>

</body>

</html>