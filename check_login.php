<?php
session_start();
if($_SESSION['MM_Username']==""){
	echo "<script>alert('对不起，请通过正确的物业管理系统!');window.location.href='login.php';</script>";
}
?>
