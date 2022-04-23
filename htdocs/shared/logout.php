<?php
    require "shared.php";

    session_start();
<<<<<<< HEAD
    //var_dump($_SESSION);
    if(isset($_GET['uuid'])){
        sessionRemoveUserByUUID($_GET['uuid']);
    }
=======
    session_unset();
    session_destroy();
>>>>>>> parent of 988ab45 (added mutiuser login on one browser support)

    redirectPageTo("../index.php");
?>