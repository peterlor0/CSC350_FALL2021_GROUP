<!DOCTYPE html>

<?php require "shared/shared.php"; ?>

<html>

<head>
    <title>ABC laundry login</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="shared/shared.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php
    session_start();
    var_dump($_SESSION);
    ?>

    <h1>Welcome to ABC laundry room</h1>


    <div class="container">

        <?php

        if (isset($_POST['username'])) {
            $conn = startSQLConnect();

            $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_POST['username']}'";
            $query = $conn->query($sql);

            $flag = false;

            if ($query && $query->num_rows > 0) {
                $row = mysqli_fetch_assoc($query);

                if ($row['Password'] == $_POST['password']) {
                    $flag = true;
                } else {
                    echo "<p class='err'>Password incorrect</p>";
                }
            } else {
                echo "<p class='err'>Account not found</p>";
            }


            if ($flag) {
                $uuid = sessionAddUser($_POST['username'], $row['AptNum']);

                redirectPageTo("main page/main.php?uuid={$uuid}");
            }

            $conn->close();
        }
        ?>

        <form method="post">
            <table class="center">
                <tr>
                    <td>
                        <ion-icon name="person-outline"></ion-icon>
                        <label>Username:</label>
                    </td>
                    <td>
                        <?php
                        if (isset($_POST['username'])) {
                            echo "<input type='text' name='username' value='{$_POST['username']}' required>";
                        } else {
                            echo "<input type='text' name='username' required>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <label>Password:</label>
                    </td>
                    <td>
                        <input type="password" name="password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Login" style="width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Don't have an account? <a href="signup page/signup.php">Signup</a> now
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script src="shared/autoCenter.js"></script>

</body>

</html>