<?php
session_set_cookie_params(0);
session_start();
session_destroy();
$_SESSION = array();

    header("Location:loginpage.html");
    exit();



?>