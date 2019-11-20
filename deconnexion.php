<?php
    session_start();
    $_SESSION =array();
    session_destroy();
    setcookie('id','',time());
    setcookie('token','',time());
    header('Location: index.php');

?>