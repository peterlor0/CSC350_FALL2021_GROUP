<?php
$fd=mysqli_connect("127.0.0.1","root","root");

if($fd){
    $q=mysqli_query($fd,"SELECT * FROM test.new_table");

    while($ret=mysqli_fetch_assoc($q)){
        echo $ret["name"] . "<br>";
    }
}

$fd->close();
?>