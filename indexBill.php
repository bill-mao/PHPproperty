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

$currentPage = $_SERVER["PHP_SELF"];



$maxRows_bill_record = 20;
$pageNum_bill_record = 0;
if (isset($_GET['pageNum_bill_record'])) {
  $pageNum_bill_record = $_GET['pageNum_bill_record'];
}
$startRow_bill_record = $pageNum_bill_record * $maxRows_bill_record;

$totalRows_bill_record = "bill";
if (isset($_SESSION['MM_Username'])) {
  $totalRows_bill_record = $_SESSION['MM_Username'];
}
$day_bill_record = "2013-09-16";
if (isset($_GET['day'])) {
  $day_bill_record = $_GET['day'];
}
mysql_select_db($database_conn, $conn);
$query_bill_record = sprintf("SELECT * FROM own ,bill WHERE own.ownerID= %s and bill.houseID=own.houseID  and bill.date=%s", GetSQLValueString($totalRows_bill_record, "text"),GetSQLValueString($day_bill_record, "date"));
$query_limit_bill_record = sprintf("%s LIMIT %d, %d", $query_bill_record, $startRow_bill_record, $maxRows_bill_record);
$bill_record = mysql_query($query_limit_bill_record, $conn) or die(mysql_error());
$row_bill_record = mysql_fetch_assoc($bill_record);

if (isset($_GET['totalRows_bill_record'])) {
  $totalRows_bill_record = $_GET['totalRows_bill_record'];
} else {
  $all_bill_record = mysql_query($query_bill_record);
  $totalRows_bill_record = mysql_num_rows($all_bill_record);
}
$totalPages_bill_record = ceil($totalRows_bill_record/$maxRows_bill_record)-1;

$queryString_bill_record = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_bill_record") == false && 
        stristr($param, "totalRows_bill_record") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_bill_record = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_bill_record = sprintf("&totalRows_bill_record=%d%s", $totalRows_bill_record, $queryString_bill_record);
 
if(!isset($_SESSION))
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bill_check</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE4 {
	font-size: 12px;
	color: #1F4A65;
	font-weight: bold;
}

a:link {
	font-size: 12px;
	color: #06482a;
	text-decoration: none;

}
a:visited {
	font-size: 12px;
	color: #06482a;
	text-decoration: none;
}
a:hover {
	font-size: 12px;
	color: #FF0000;
	text-decoration: underline;
}
a:active {
	font-size: 12px;
	color: #FF0000;
	text-decoration: none;
}
.STYLE7 {font-size: 12}
body,td,th {
	font-size: 9px;
}

-->
</style>

<script>
var  highlightcolor='#d5f4fe';
//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
var  clickcolor='#51b2f6';
function  changeto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=highlightcolor&&source.id!="nc"&&cs[1].style.backgroundColor!=clickcolor)
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=highlightcolor;
}
}

function  changeback(){
if  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="nc")
return
if  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)
//source.style.backgroundColor=originalcolor
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}

function  clickto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=clickcolor&&source.id!="nc")
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=clickcolor;
}
else
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}
</script>
</head>

<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="30"><img src="images/tab_03.gif" width="15" height="30" /></td>
        <td background="images/tab_05.gif"><img src="images/311.gif" width="16" height="16" /> <span class="STYLE4"><?php echo $_SESSION['MM_Username']; ?> 账单列表</span></td>
        <td width="14"><img src="images/tab_07.gif" width="14" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="9" background="images/tab_12.gif">&nbsp;</td>
        <td bgcolor="e5f1d6"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CECECE" onmouseover="changeto()"  onmouseout="changeback()">
        
        
          <tr>
            <td  height="26" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">选择</div></td>
            <td  height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">ID</div></td>
            <td  height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">日期</div></td>
            <td  height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">本月用水量</div></td>
            <td width="14%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">水费</div></td>
            <td height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2">本月用电量</div></td>
             <td width="8%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">电费</div></td>
              <td width="8%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">物业费</div></td>
              <td width="8%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">总费用费</div></td>
              
               <td width="8%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2 STYLE1">是否交费</div></td>
            <td width="7%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2">编辑</div></td>
            <td width="7%" height="18" background="images/tab_14.gif" class="STYLE1"><div align="center" class="STYLE2">删除</div></td>
          </tr>
          
          
          <?php 
		  $water=$elec=0;
		do{
			 $waterFee=($row_bill_record['current_month_water']-$water)*$row_bill_record['price_water'];
			 $elecFee=($row_bill_record['current_month_elec']-$elec)*$row_bill_record['price_water'];
			  ?>
            <tr>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
                <input name="checkbox" type="checkbox" class="STYLE2" value="checkbox" />
              </div></td>
              <td height="18" bgcolor="#FFFFFF" class="STYLE2"><div align="center" class="STYLE2 STYLE1"><?php echo $row_bill_record['ID']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"><?php echo $row_bill_record['date']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"><?php echo $row_bill_record['current_month_water']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"> <?php echo $waterFee ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" ><a href="#"><?php echo $row_bill_record['current_month_elec']; ?></a></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"> <?php echo $elecFee ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"> <?php echo $row_bill_record['price_property']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"> <?php echo $waterFee+$elecFee+$row_bill_record['price_property']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center" class="STYLE2 STYLE1"><?php echo $row_bill_record['paid_property']; ?></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center"><img src="images/037.gif" width="9" height="9" /><span class="STYLE1"> [</span><a href="#">交费</a><span class="STYLE1">]</span></div></td>
              <td height="18" bgcolor="#FFFFFF"><div align="center"><span class="STYLE2"><img src="images/010.gif" width="9" height="9" /> </span><span class="STYLE1">[</span><a href="#">删除</a><span class="STYLE1">]</span></div></td>
            </tr>
            <?php  $water=$row_bill_record['current_month_water'];
					$elec=$row_bill_record['current_month_elec'];}
			 while ($row_bill_record = mysql_fetch_assoc($bill_record)	);	?>
          
          
          <tr>
            <td height="18" colspan="8" bgcolor="#FFFFFF">
             <td height="18" bgcolor="#FFFFFF"><div align="center"><img src="images/037.gif" width="9" height="9" /><span class="STYLE1"> [</span><a href="#">交费</a><span class="STYLE1">]</span></div></td>
             
          
          
        </table> 
        <td width="9" background="images/tab_16.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  
  
  <tr>
    <td height="29"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="29"><img src="images/tab_20.gif" width="15" height="29" /></td>
        <td background="images/tab_21.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="21%" height="29">共有<?php echo $totalRows_bill_record ?> 条记录  现在在第<?php echo ($startRow_bill_record + 1) ?>条到<?php echo min($startRow_bill_record + $maxRows_bill_record, $totalRows_bill_record) ?>条</td>
            <td width="79%" valign="top" class="STYLE1"><div align="right">
              <table width="352" height="20" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="62" height="22" valign="middle"><div align="right"><a href="<?php printf("%s?pageNum_bill_record=%d%s", $currentPage, 0, $queryString_bill_record); ?>"><img src="images/first.gif" width="46" height="20" /></a></div></td>
                  <td width="50" height="22" valign="middle"><div align="right"><a href="<?php printf("%s?pageNum_bill_record=%d%s", $currentPage, max(0, $pageNum_bill_record - 1), $queryString_bill_record); ?>"><img src="images/back.gif" width="46" height="20" /></a></div></td>
                  <td width="54" height="22" valign="middle"><div align="right"><a href="<?php printf("%s?pageNum_bill_record=%d%s", $currentPage, min($totalPages_bill_record, $pageNum_bill_record + 1), $queryString_bill_record); ?>"  ><img src="images/next.gif" width="46" height="20" /></a></div></td>
                  <td width="49" height="22" valign="middle"><div align="right"><a href="<?php printf("%s?pageNum_bill_record=%d%s", $currentPage, $totalPages_bill_record, $queryString_bill_record); ?>"><img src="images/last.gif" width="46" height="20" /></a></div></td>
                  <td width="59" height="22" valign="middle"><div align="right">转到</div></td>
                 <!--input 利用js获取值 herf 跳转-->
                 <form name="dayform" action="indexBill.php" method="get">
                  <td width="25" height="22" valign="middle"><span class="STYLE7">
                    <input id='page' name="day" type="text" class="STYLE1" style="height:10px; width:25px;" size="5" />
                   
                  </span></td>
                  <td width="23" height="22" valign="middle">日期</td>
                  <td width="30" height="22" valign="middle"><a><input name="day" type="submit" /></a></td> </form>
                  
                 
                  
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

</body>
</html>
<?php
mysql_free_result($bill_record);
?>
