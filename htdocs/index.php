<!DOCTYPE html>

<?php require "shared.php"?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="./shared.css">
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <?php
    if (isset($_POST['username'])) {
        $conn = startSQLConnect();

        $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_POST['username']}'";
        $ret = $conn->query($sql);

        $flag = false;

        if ($ret) {
            $row = mysqli_fetch_row($ret);

            if ($row) {
                if ($row[1] == $_POST['password']) {
                    $flag = true;
                } else { ?>
                    <p class="err">Password incorrect</p>
                <?php
                }
            } else { ?>
                <p class="err">Username not found</p>
    <?php
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        if ($flag) {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header("Location: ./main page/main.php");
            exit();
        }
    }
    ?>

    <form action="#" method="post">
        <table class="center">
            <tr>
                <td>
                    <label>Username:</label>
                </td>
                <td>
                    <input type="text" name="username" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password:</label>
                </td>
                <td>
                    <input type="password" name="password" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Signin" style="width: 100%;">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="./Signup Page/signup.html">Signup</a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>