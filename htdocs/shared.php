<?php

function startSQLConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    return $conn;
}



?>

<?php  ?>