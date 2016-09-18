<?php

?>
<?php require_once('Connections/conn.php'); ?>
<?php require_once('Connections/conn.php');
if(!isset($_SESSION))
	session_start(); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO own (houseID, ownerID, ownership) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['houseID'], "int"),
                       GetSQLValueString($_POST['ownID'], "text"),
                       GetSQLValueString($_POST['ownership'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

  $insertGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body style="background-image:url(Images/register.jpg)">
<div  align="center">
<form action="<?php echo $editFormAction; ?>"   method="POST" name="form1" target="_blank">
<table  width="80%" border="1"  align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th valign="middle" scope="col">用户ID</th>
    <th scope="col">所有权</th>
    <th rowspan="2" scope="col"><input type="submit" name="summit" id="summit" value="提交" /></th>
  </tr>
  <tr>
    <td><label for="ownID"></label>
      <input type="text" name="ownID" id="ownID" /></td>
    <td><label for="ownership"></label>
      <input type="text" name="ownership" id="ownership" /></td>
    </tr>
</table>

<input type="hidden" name="houseID" value=<?php echo $_GET['houseID'] ?> />
<input type="hidden" name="MM_insert" value="form1" />
</form>
</div>


</body>
</html>