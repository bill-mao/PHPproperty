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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE householder SET name=%s, phone=%s, pwd=%s, sex=%s, birth=%s, question=%s, answer=%s, IDNum=%s WHERE ID=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['pwd'], "text"),
                       GetSQLValueString($_POST['RadioGroup1'], "text"),
                       GetSQLValueString($_POST['user_date'], "date"),
                       GetSQLValueString($_POST['question'], "text"),
                       GetSQLValueString($_POST['answer'], "text"),
                       GetSQLValueString($_POST['ID_num'], "text"),
                       GetSQLValueString($_POST['ID'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_update = "-1";
if (isset($_GET['ID'])) {
  $colname_update = $_GET['ID'];
}
mysql_select_db($database_conn, $conn);
$query_update = sprintf("SELECT * FROM householder WHERE ID = %s", GetSQLValueString($colname_update, "text"));
$update = mysql_query($query_update, $conn) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update user info</title>
</head>

<body>
<div style="background-image:url(Images/register.jpg)" align="center">
<form name="form1" action="<?php echo $editFormAction; ?>" method="POST" id="form1" target="_blank">
<table width="419" border="1" cellspacing="2" cellpadding="2" summary="摘要">
  <caption>
    您现在可以修改您的账号
  </caption>
  <tr>
    <th width="17" scope="row">登录账号</th>
    <td width="382">
    <label><input name="ID" type="text" id="ID" value="<?php echo $row_update['ID']; ?>" readonly="readonly" />
    只读账号名不能修改</label>
    </td>
  </tr>
  <tr>
    <th scope="row">密码</th>
    <td><input type="text" name="pwd" id="pwd" /></td>
  </tr>
  <tr>
    <th scope="row">密码验证</th>
    <td><input type="text" name="pwd2" id="pwd2" /></td>
  </tr>
  <tr>
    <th scope="row">身份证号</th>
    <td><input name="ID_num" type="text" id="ID_num" value="<?php echo $row_update['IDNum']; ?>" /></td>
  </tr>
  <tr>
    <th scope="row">真实姓名</th>
    <td><input name ="name" type="text" id="realname" value="<?php echo $row_update['name']; ?>" /></td>
  </tr>
  <tr>
    <th scope="row">手机号</th>
    <td><input name="phone" type="text" id="phone" value="<?php echo $row_update['phone']; ?>" /></td>
  </tr>
  <tr>
    <th scope="row">性别</th>
    <td><table width="200">
      <tr>
        <td nowrap="nowrap"><label>
          <input name="RadioGroup1" type="radio" id="RadioGroup1_0" value="男" checked="checked" />
          男</label></td>
        <td nowrap="nowrap">&nbsp;<label>
          <input type="radio" name="RadioGroup1" value="<?php echo $row_update['sex']; ?>" id="RadioGroup1_1" />
          女</label></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <th scope="row">出生年月</th>
    <td> 
    <input name="user_date" type="date" id="date" value="<?php echo $row_update['birth']; ?>" />
</td>
  </tr>
  <tr>
    <th scope="row">密码找回问题</th>
    <td><textarea name="question" id="question" cols="45" rows="5"><?php echo $row_update['question']; ?></textarea></td>
  </tr>
  <tr>
    <th scope="row">找回答案</th>
    <td><input name="answer" type="text" id="answer" value="<?php echo $row_update['answer']; ?>" /></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><label for="修改ID">修改</label>
      <input name="修改ID" type="submit" id="修改ID" style=" CURSOR: hand ; background:url('Images/dl.gif ') no-repeat;width:39 ;height:19 " value="      " > </input>      &nbsp;</th>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
<input type="hidden" name="MM_update" value="form1" />
</form>
</div>
</body>
</html>
<?php
mysql_free_result($update);
?>
