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

    <h1>SignUp</h1>

    <?php
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['roomnum'])) {
        $conn = startSQLConnect();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO mgr.userdata (Username, Password, RoomNum)
        VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['roomnum']}')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>User Created</p><br>";
            echo "<a href='../index.php'>Continue to login</a>";
        } else {
    ?>
            <p class="err">Could not create account</p>
            <form method="post">
                <table class="center">
                    <tr>
                        <td>
                            <ion-icon name="person-outline"></ion-icon>
                            <label>Username:</label>
                        </td>
                        <td>
                            <?php
                            echo "<input id='username' type='text' name='username' value='{$_POST['username']}' required>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <label>Password:</label>
                        </td>
                        <td>
                            <input id="password" type="password" name="password" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ion-icon name="home-outline"></ion-icon>
                            <label>Room:</label>
                        </td>
                        <td>
                            <?php
                            echo "<input id='roomnum' type='text' name='roomnum' value='{$_POST['roomnum']}' required>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick="return submitCheck()" value="Submit" style="width: 100%;">
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
        <?php
        }

        $conn->close();
    } else {
        ?>

        <form method="post">
            <table class="center">
                <tr>
                    <td>
                        <ion-icon name="person-outline"></ion-icon>
                        <label>Username:</label>
                    </td>
                    <td>
                        <input id="username" type="text" name="username" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <label>Password:</label>
                    </td>
                    <td>
                        <input id="password" type="password" name="password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ion-icon name="home-outline"></ion-icon>
                        <label>Room:</label>
                    </td>
                    <td>
                        <input id="roomnum" type="text" name="roomnum" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" onclick="return submitCheck()" value="Submit" style="width: 100%;">
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

    <?php

    }
    ?>



</body>

</html>