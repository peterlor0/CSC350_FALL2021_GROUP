<?php
    require "shared.php";

    session_start();
    //var_dump($_SESSION);
    if(isset($_GET['uuid'])){
        sessionRemoveUserByUUID($_GET['uuid']);
    }

    redirectPageTo("../index.php");
?>