<?php require_once('../Connections/conn.php'); ?>
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

$colname_record = "-1";
if (isset($_POST['nameID'])) {
  $colname_record = $_POST['nameID'];
}
mysql_select_db($database_conn, $conn);
$query_record = sprintf("SELECT ID, name, phone, pwd, question, answer FROM householder WHERE ID = %s", GetSQLValueString($colname_record, "text"));
$record = mysql_query($query_record, $conn) or die(mysql_error());
$row_record = mysql_fetch_assoc($record);
$totalRows_record = mysql_num_rows($record);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lostPwd</title>
</head>
<body>
<h3>请输入您的用户名</h3>
<div>
  <form action="" method="post" name="form1" target="_self">
    <input name="nameID" type="text" maxlength="20" />
    <input name="summit" type="submit" value="提交" />
  </form>
</div>
<?php if ($totalRows_record == 0) { // Show if recordset empty ?>
  <h4>该用户不存在</h4>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_record > 0) { // Show if recordset not empty ?>

 <script type="text/javascript">

function validate_required(field,alerttxt)
{
with (field)
  {
  if (value!="{$row_record['answer']}")
    {alert(alerttxt);return false}
  else {
  document.getElementById("out").innerHTML="您的密码是{$row_record['pwd']}";
  return true}
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(answer,"问题的答案有误，请重新输入")==false)
    {answer.focus();return false}
  }
}
</script>	
 <div>
    <p><?php echo $row_record['question']; ?></p>
    <form action="" method="post" onsubmit="return validate_form(this)" name="form2" target="_self">
      <input name="answer" type="text" maxlength="40" />
      <input name="summit2" type="submit" type="hidden" value="提交" />
    </form>
  </div>
   
 
  <div><p id="out">您的密码是</p></div>
  <?php } // Show if recordset not empty ?>
  
  
  
  
  
 
  
  
  
  
  
  
  
</body>
</html>
<?php
mysql_free_result($record);
?>
