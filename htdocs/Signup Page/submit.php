<html>

<head>
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

  $sql = "INSERT INTO mgr.userdata (Username, Password, RoomNum)
    VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['roomno']}')";

  if ($conn->query($sql) === TRUE) {
    echo "<p>user created</p><br>";
    echo "<a href='../main.html'>Continue to login</a>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  ?>
</body>

</html>