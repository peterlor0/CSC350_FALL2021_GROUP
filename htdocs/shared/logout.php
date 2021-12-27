<?php
    require "shared.php";

    session_start();
    session_unset();
    session_destroy();

    redirectPageTo("../index.php");
?>