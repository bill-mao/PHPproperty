<?php require_once('Connections/conn.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO house (city, subdistrict, building, unit, room) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['subdistrict'], "text"),
                       GetSQLValueString($_POST['building'], "text"),
                       GetSQLValueString($_POST['unit'], "text"),
                       GetSQLValueString($_POST['room'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body style="background-image:url(Images/register.jpg)" align="center" >
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
<table align="center" width="80%" border="1" cellspacing="2" cellpadding="2">
  <caption>
    注册房屋
  </caption>
  <tr>
    <th scope="row">city</th>
    <td><input type="text" name="city" id="city" /></td>
  </tr>
  <tr>
    <th scope="row">subdistrict</th>
    <td><input type="text" name="subdistrict" id="subdistrict" /></td>
  </tr>
  <tr>
    <th scope="row">building</th>
    <td><input type="text" name="building" id="building" /></td>
  </tr>
  <tr>
    <th scope="row">unit</th>
    <td><input type="text" name="unit" id="unit" /></td>
  </tr>
  <tr>
    <th scope="row">room</th>
    <td><input type="text" name="room" id="room" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit"  /></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
</form>



</body>
</html>