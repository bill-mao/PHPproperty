<?php require_once('Connections/conn.php'); ?>
<?php
// 自动转到 header('Location: http://www.example.com/');

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['ID'])) {
  $loginUsername=$_POST['ID'];
  $password=$_POST['pwd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "admin_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  
  $LoginRS__query=sprintf("SELECT ID, pwd FROM `admin` WHERE ID=%s AND pwd=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow:hidden;
}
.STYLE1 {font-size: 12px}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin_login</title>
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="9fc967">&nbsp;</td>
  </tr>
  <tr>
    <td height="604"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="604" background="images/login_02.gif"></td>
          <td width="989"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="345" background="images/login_1.jpg"></td>
                <td background="images/login_1.jpg"></td>
              </tr>
              <tr>
                <td height="47"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="539" height="47" background="images/login_05.gif" nowrap="nowrap">&nbsp;</td>
                      <td width="206" background="images/login_06.gif" nowrap="nowrap"><form METHOD="POST" action="<?php echo $loginFormAction; ?>" id="form1" methord="POST">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17%" height="22"><div align="center"><span class="STYLE1">用户</span></div></td>
                              <td width="58%" height="22"><div align="center">
                                  <input name="ID" type="text" size="15" placeholder="输入您的注册ID" style="height:17px; border:solid 1px #bbbbbb">
                                </div></td>
                              <td width="25%" height="22">&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="22"><div align="center"><span class="STYLE1">密码</span></div></td>
                              <td height="22"><div align="center">
                                  <input name="pwd" type="password" size="15" style="height:17px; border:solid 1px #bbbbbb">
                                </div></td>
                              <td height="22"><div align="center">
                                  <input   name="summit" type="submit" style=" CURSOR: hand ; background:url('Images/dl.gif ') no-repeat;width:44 ;height:19 " value="    "  >
                                </div></td>
                            </tr>
                            <tr style="position:absolute ; top:50% ; left:80%">
                             
                            </tr>
                          </table>
                        </form></td>
                      <td width="244" background="images/login_07.gif" nowrap="nowrap">&nbsp;</td>
                    </tr>
                  </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="212" background="images/login_08.gif"><!-- js显示时间--> 
                  <script type=text/javascript>
		document.write("<span id='labtime' width='120px' Font-Size='9pt'></span>")
		setInterval("labtime.innerText=new Date().toLocaleString()",1000)
</script></td>
                <td background="images/login_08.gif">&nbsp;</td>
              </tr>
            </table></td>
          <td background="images/login_04.gif">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="70ad21">&nbsp;</td>
  </tr>
</table>
</body>
</html>