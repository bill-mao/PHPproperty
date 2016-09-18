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

$colname_record = "-1";
if (isset($_POST['ID'])) {
  $colname_record = $_POST['ID'];
}
mysql_select_db($database_conn, $conn);
$query_record = sprintf("SELECT pwd, question, answer FROM householder WHERE ID = %s", GetSQLValueString($colname_record, "text"));
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
<body style="background-image:url(Images/register.jpg)">
<div align="center" >
<div id="name" style="display:<?php if (empty($row_record['answer'])) echo 'block' ; else echo'none' ?> ">
<form  method="post" name="form1" target="_self" >
<p  style="font:x-large ; color:#F09">请输入您的的用户名</p>
<input type="text" name="ID"  />
<button type="summit" >提交</button>
</form> 
</div>

<div id="hidden" style="display:<?php if (empty($row_record['answer'])) echo 'none' ; else echo'block' ?> ">
<form  name="form2" >
<p style="font:x-large ; color:#F09">问题：<?php echo $row_record['question']; ?></p>
<input id='answer' type="text" name="answer"  />
<button type="button"  value="提交"  onclick="showAnswer()">提交</button>
</form> 
</div> 

<p id='code' style="display:none">您的密码：<?php echo $row_record['pwd']; ?></p>
<div><a href="login.php">点此重新登录</a></div>
</div>  


    
<script type="text/javascript" >
function showAnswer(){	
	var ans="<?php echo $row_record['answer']; ?>";
	var yourAns=document.getElementById('answer').value;
	
	if(ans != yourAns){
		alert('您输入错误，请重新输入');  }
	else	{
		document.getElementById('code').style.display='block';
		document.getElementById('hidden').style.display='none';
		alert('密码显示');
	}
}

</script>



</body>
</html>
<?php
mysql_free_result($record);
?>
