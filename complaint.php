
<?php require_once('Connections/conn.php'); ?>
<?php require_once('Connections/conn.php');

if(!isset($_SESSION))
	session_start();
 ?>
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
  $insertSQL = sprintf("INSERT INTO complaint (userID, content, `date`) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['text'], "text"),
                       GetSQLValueString($_POST['day'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO bring (user_ID, complaint_ID) VALUES (%s, %s)",
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['bringSet'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

mysql_select_db($database_conn, $conn);
$query_num = "select max(ID)  from complaint ";
$num = mysql_query($query_num, $conn) or die(mysql_error());
$row_num = mysql_fetch_assoc($num);
$totalRows_num = mysql_num_rows($num);

if(!isset($_SESSION))
	session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户投诉</title>
<script type="text/javascript" src="JS/menu.JS"></script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15" height="30"><img src="images/tab_03.gif" width="15" height="30" /></td>
          <td background="images/tab_05.gif"><img src="images/311.gif" width="16" height="16" /> <span class="STYLE4"><?php echo $_SESSION['MM_Username']?> 欢迎您对**物业提出您宝贵的建议</span></td>
          <td width="14"><img src="images/tab_07.gif" width="14" height="30" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td  colspan="2" style="width:400 ;font-size: xx-small;color: #633;">&nbsp;&nbsp;您的建议会发送到对应的管理员的那里
 倘若您的问题解决，请您在您的建议那里确认问题解决。谢谢~</td></tr>
        <tr>
          <td width="9" background="images/tab_12.gif">&nbsp;</td>
          <td bgcolor="#CCE8CF"><form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
              <table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CECECE" >
                <tr>
                  <td bgcolor="#999999" >问题详细描述：</td>
                  <td><textarea name="text"  cols="70" rows="22"  autofocus="autofocus" placeholder="输入详细的问题：eg时间 地点 涉及的人，我们会尽快给您回复的，谢谢合作。" ></textarea></td>  
                  <td> <input type="hidden" name =userID value="<?php echo $_SESSION['MM_Username'] ?> ">  </td> 
				  <td><input type="hidden" name="day" value=" <?php echo date("y-m-d") ?>" />  </td>
                  <td> <input type="hidden" name = "bringSet" value="<?php echo $row_num['max(ID)']+1; ?>"  /></td>               
				     <td><img src="Images/mail.jpg" height="330" /></td>
                </tr>
                <tr>
                  <td><br /></td>
                </tr>
                <tr>
                  <td><br /></td>
                </tr>
                <tr>
                  <td><br /></td>
                </tr>
                <tr align="right" valign="bottom">
                  <td colspan="3"><button type="submit" onclick="changeSrcCL()">提交</button>
                  <button type="reset">重置</button></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1" />
            </form></td>
          <td width="9" background="images/tab_16.gif">&nbsp;</td>
        </tr>
    
       
      </table></td>
  </tr>
  <tr>
    <td height="29"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15" height="29"><img src="images/tab_20.gif" width="15" height="29" /></td>
          <td background="images/tab_21.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> </tr>
            </table></td>
          <td width="14"><img src="images/tab_22.gif" width="14" height="29" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($num);
?>
