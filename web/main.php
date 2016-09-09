<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
</head>

<body>
<table width="269" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td width="257"><!-- #BeginDate format:Ch1a -->16/9/9  3:29 PM<!-- #EndDate -->
    登陆成功！欢饮您：<?php echo $_SESSION['MM_username']; ?></td>
  </tr>
  <tr>
    <td><a href="../login/update.php" >修改您的个人信息</a>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="<?php echo $logoutAction ?>" herf="../login/login.php">注销您的账户</a>&nbsp;</td>
  </tr>
</table>
</body>
</html>