<!DOCTYPE html>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/shared.php";
?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="/shared.css">
    <link rel="stylesheet" href="./index.css">

</head>

<body>

    <?php
    session_start();
    if(isset($_SESSION['username'])){
        redirectPageTo("/main page/main.php");
    }

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
            $_SESSION['username'] = $_POST['username'];

            redirectPageTo("/main page/main.php");
        }
    }
    ?>

    <form method="post">
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
                    Don't have an account? <a href="./Signup Page/signup.html">Signup</a> now
                </td>
            </tr>
        </table>
    </form>
</body>

</html>