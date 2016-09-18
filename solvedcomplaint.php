<?php require_once('Connections/conn.php'); ?>
<?php
if(!isset($_SESSION))
	session_start();
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

$session_Recordset1 = "-1";
if (isset($_SESSION['Username'])) {
  $session_Recordset1 = $_SESSION['Username'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("select complaint.userID ,complaint.content ,complaint.date from manage ,own ,bring, complaint where manage.adminID=%s and manage.houseID=own.houseID and own.ownerID= bring.user_ID and bring.complaint_ID= complaint.ID", GetSQLValueString($session_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$totalRows_Recordset1 = "root";
if (isset($_SESSION['Username'])) {
  $totalRows_Recordset1 = $_SESSION['Username'];
}


mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT complaint.userID ,complaint.content ,complaint.date FROM manage ,own ,bring, complaint WHERE manage.adminID=%s and manage.houseID=own.houseID and own.ownerID= bring.user_ID and bring.complaint_ID= complaint.ID", GetSQLValueString($session_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$session_Recordset1 = "root";
if (isset($_SESSION['Username'])) {
  $session_Recordset1 = $_SESSION['Username'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT complaint.userID ,complaint.content ,complaint.date FROM manage ,own ,bring, complaint WHERE manage.adminID=%s and manage.houseID=own.houseID and own.ownerID= bring.user_ID and bring.complaint_ID= complaint.ID", GetSQLValueString($session_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>历史投诉</title>
<style type="text/css">
<!--
.STYLE1 {
	font-size: 12px
}
-->
</style>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15" height="30"><img src="images/tab_03.gif" width="15" height="30" /></td>
          <td background="images/tab_05.gif"><img src="images/311.gif" width="16" height="16" /> <span class="STYLE4"> 管理员您已经解决的投诉</span></td>
          <td width="14"><img src="images/tab_07.gif" width="14" height="30" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table draggable="true" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
          <td width="6%" height="26" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">选择</div></td>
          <td width="8%" height="18" background="images/tab_14.gif" class="STYLE1">用户名</td>
          <td width="24%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">日期</div></td>
          <td width="10%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">内容</div></td>
          <td width="7%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2">编辑</div></td>
        </tr>
        <?php do { ?>
          <tr>
            <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
                <input name="checkbox" type="checkbox" class="STYLE2" />
              </div></td>
            <td height="18" bgcolor="#FFFFFF" class="STYLE2"><div align="center" class="STYLE2 STYLE1"><?php echo $row_Recordset1['userID']; ?></div></td>
            <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"><?php echo $row_Recordset1['date']; ?></div></td>
            <td height="18" bgcolor="#FFFFFF"><?php echo $row_Recordset1['content']; ?></td>
            <td height="18" bgcolor="#FFFFFF"><div align="center"><img src="images/037.gif" width="9" height="9" /><span class="STYLE1"> [</span><a href="#">编辑</a><span class="STYLE1">]</span></div></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        <tr><br />
        </tr>
        <tr><br />
        </tr>
        <tr><br />
        </tr>
        <tr><br />
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="29"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15" height="29"><img src="images/tab_20.gif" width="15" height="29" /></td>
          <td background="images/tab_21.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="21%" height="29">共有*页  现在在第 n 页</td>
                <td width="79%" valign="top" class="STYLE1"><div align="right">
                    <table width="352" height="20" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="62" height="22" valign="middle"><div align="right"><img src="images/first.gif" width="46" height="20" /></div></td>
                        <td width="50" height="22" valign="middle"><div align="right"><img src="images/back.gif" width="46" height="20" /></div></td>
                        <td width="54" height="22" valign="middle"><div align="right"><img src="images/next.gif" width="46" height="20" /></div></td>
                        <td width="49" height="22" valign="middle"><div align="right"><img src="images/last.gif" width="46" height="20" /></div></td>
                        <td width="59" height="22" valign="middle"><div align="right">转到第</div></td>
                        <td width="25" height="22" valign="middle"><span class="STYLE7">
                          <input name="textfield" type="text" class="STYLE1" style="height:10px; width:25px;" size="5" />
                          </span></td>
                        <td width="23" height="22" valign="middle">页</td>
                        <td width="30" height="22" valign="middle"><img src="images/g_page.gif" width="14" height="14" /></td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
            </table></td>
          <td width="14"><img src="images/tab_22.gif" width="14" height="29" /></td>
        </tr>
      </table></td>
  </tr>
</table>
<script type='text/javascript'>
function update(i){
var id = document.getElementById('comID'+i).value;
alert ('您将确认解决complaint id ：'+id);
document.getElementById('inputID').value=id;
document.getElementById('form1').submit();	
}

</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
