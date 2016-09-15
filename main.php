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
  $_SESSION['rname'] = NULL;
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
<table width="90%" height="182" border="1" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td height="62" align="right"><?php require('navigation.php')   ?></td>
  </tr>
  <tr>
    <td width="711" height="62" align="right"><p><!-- #BeginDate format:Ch1a -->16/9/15  9:46 PM<!-- #EndDate -->
      登陆成功！欢迎您：<?php echo $_SESSION['MM_Username']; ?></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="36" align="right">
    <a href=check_bill.php?ID=<?php echo $_SESSION['MM_Username']; ?>>check_bill </a>
    &nbsp;</td>
  </tr>
  <tr>
    <td><a href="<?php echo $logoutAction ?>" herf="login.php"></a>&nbsp;</td>
  </tr>
</table>
</body>
</html>