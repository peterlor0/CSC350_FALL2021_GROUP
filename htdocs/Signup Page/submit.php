<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    
    // Create connection
    $conn = mysqli_connect($servername,$username,$password);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO mgr.userdata (Username, Password)
    VALUES ({$_POST['username']}, {$_POST['password']})";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>