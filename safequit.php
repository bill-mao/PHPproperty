<?php
session_start();
session_unset();
session_destroy();
//parent.window.close();
header("location:login.php");
?>