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
  $insertSQL = sprintf("INSERT INTO bill (houseID, `date`, current_month_water, price_water, current_month_elec, price_elec, price_property, paid_property) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['houseID'], "int"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['water'], "int"),
                       GetSQLValueString($_POST['priwater'], "int"),
                       GetSQLValueString($_POST['elec'], "int"),
                       GetSQLValueString($_POST['priele'], "int"),
                       GetSQLValueString($_POST['elec'], "int"),
                       GetSQLValueString($_POST['paid'], "int"));

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

<body>
<div style="background-image:url(Images/register.jpg)" align="center">
<form action="<?php echo $editFormAction; ?>" name="form1" method="POST" id="form1" target="_blank">
<table width="419" border="1" cellspacing="2" cellpadding="2" summary="摘要">
  <caption>
    编辑 <?php echo $data =$_GET['houseID']; ?> 房屋的账单
  </caption>
  <tr>
    <th width="17" scope="row">本月电表电量</th>
    <td width="382"><input type="text" name="elec" id="pwd" /></td>
  </tr>
  <tr>
    <th scope="row">本月水表量</th>
    <td><input type="text" name="water" id="pwd2" /></td>
  </tr>
  <tr>
    <th scope="row">电费单价</th>
    <td><input name="priele" type="text" id="ID_num" /></td>
  </tr>
  <tr>
    <th scope="row">水费单价</th>
    <td><input name ="priwater" type="text" id="realname" /></td>
  </tr>
  <tr>
    <th scope="row">物业费</th>
    <td>
    <input name ="priproperty" type="text" id="realname" />
    
    </td>
  </tr>
  <tr>
    <th scope="row">是否支付</th>
    <td><input name="paid" type="text" id="phone2" /></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><label for="修改ID">bill</label>
      <input name="修改ID" type="submit" id="修改ID" style=" CURSOR: hand ;width:39 ;height:19 " value="确认" > </input>      &nbsp;</th>
  </tr>
</table>
<input name ="houseID" type="hidden" value="<?php echo $data =$_GET['houseID']; ?>"  />
    <input type="hidden" name="date" value=" <?php echo date("y-m-d") ?>" />
    <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
</body>
</html>