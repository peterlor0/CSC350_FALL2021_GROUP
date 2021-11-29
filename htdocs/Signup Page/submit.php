<!DOCTYPE html>
<html>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/shared.php" ?>

<head>
  <link rel="stylesheet" href="./../shared.css">
</head>

<body>
  <?php
  $conn = startSQLConnect();
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO mgr.userdata (Username, Password, RoomNum)
    VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['roomnum']}')";

  if ($conn->query($sql) === TRUE) {
    echo "<p>user created</p><br>";
    echo "<a href='../index.php'>Continue to login</a>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo "<a href='./signup.html'>Retry</a>";
  }

  $conn->close();
  ?>
</body>

</html>