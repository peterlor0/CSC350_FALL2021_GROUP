<!DOCTYPE html>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="./../shared.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";


    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM mgr.userdata WHERE Username='{$_POST['username']}'";
    $ret = $conn->query($sql);

    if ($ret) {
        $row = mysqli_fetch_row($ret);

        if ($row) {
            if ($row[1] == $_POST['password']) {
                echo "welcome back! " . $_POST['username'] . "<br>";
                echo "Room Number: " . "{$row[2]}";
                
            } else {
                echo "password error";
            }
        } else {
            echo "user not found";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>
</body>

</html>