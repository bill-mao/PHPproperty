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

$currentPage = $_SERVER["PHP_SELF"];

$colname_bill_set = "-1";
if (isset($_GET['ID'])) {
  $colname_bill_set = $_GET['ID'];
}
mysql_select_db($database_conn, $conn);
$query_bill_set = sprintf("SELECT * FROM bill WHERE ID = %s", GetSQLValueString($colname_bill_set, "int"));
$bill_set = mysql_query($query_bill_set, $conn) or die(mysql_error());
$row_bill_set = mysql_fetch_assoc($bill_set);
$maxRows_bill_set = 5;
$pageNum_bill_set = 0;
if (isset($_GET['pageNum_bill_set'])) {
  $pageNum_bill_set = $_GET['pageNum_bill_set'];
}
$startRow_bill_set = $pageNum_bill_set * $maxRows_bill_set;

$totalRows_bill_set = "-1";
if (isset($_GET['ID'])) {
  $totalRows_bill_set = $_GET['ID'];
}
mysql_select_db($database_conn, $conn);
$query_bill_set = sprintf("SELECT * FROM own  ,bill WHERE own.ownerID = %s and   bill.houseID =own.houseID  ", GetSQLValueString($totalRows_bill_set, "int"),GetSQLValueString($totalRows_bill_set, "int"),GetSQLValueString($totalRows_bill_set, "int"));
$query_limit_bill_set = sprintf("%s LIMIT %d, %d", $query_bill_set, $startRow_bill_set, $maxRows_bill_set);
$bill_set = mysql_query($query_limit_bill_set, $conn) or die(mysql_error());
$row_bill_set = mysql_fetch_assoc($bill_set);

if (isset($_GET['totalRows_bill_set'])) {
  $totalRows_bill_set = $_GET['totalRows_bill_set'];
} else {
  $all_bill_set = mysql_query($query_bill_set);
  $totalRows_bill_set = mysql_num_rows($all_bill_set);
}
$totalPages_bill_set = ceil($totalRows_bill_set/$maxRows_bill_set)-1;

$queryString_bill_set = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_bill_set") == false && 
        stristr($param, "totalRows_bill_set") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_bill_set = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_bill_set = sprintf("&totalRows_bill_set=%d%s", $totalRows_bill_set, $queryString_bill_set);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询账单</title>
</head>

<body>
<P><?php echo $_SESSION['MM_Username']; ?>welcome you to check your bill</P>
<p>&nbsp;<?php echo ($startRow_bill_set + 1) ?>~~<?php echo min($startRow_bill_set + $maxRows_bill_set, $totalRows_bill_set) ?>一共有：   &nbsp;<?php echo $totalRows_bill_set ?> </p>
<table width="784" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <th width="77" scope="col">bill_ID</th>
    <th width="87" scope="col">date</th>
    <th width="190" scope="col">current_water</th>
    <th width="133" scope="col">price_water</th>
    <th width="129" scope="col">paid_water</th>
    <th width="66" scope="col">water_fee</th>
    <th width="1" scope="col">&nbsp;</th>
    <th width="1" scope="col">&nbsp;</th>
    <th width="1" scope="col">&nbsp;</th>
    <th width="1" scope="col">&nbsp;</th>
    <th width="1" scope="col">&nbsp;</th>
    <th width="6" scope="col">&nbsp;</th>
  </tr>
  <?php 
  $lastWater=0;
  do {	?>
  <tr>
    <td><?php echo $row_bill_set['ID']; ?></td>
    <td><?php echo $row_bill_set['date']; ?></td>
    <td><?php echo $row_bill_set['current_month_water']; ?></td>
    <td><?php echo $row_bill_set['price_water']; ?></td>
    <td><?php echo $row_bill_set['paid_water']; ?></td>
    <td><?php  
	  if($lastWater ==0)
	  	echo $row_bill_set['price_water']*( $row_bill_set['current_month_water']-$lastWater['current_month_water'] ) ;
		else echo 0;
		 ?>
      &nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php  
	 } while (
	 
	 $row_bill_set = mysql_fetch_assoc($bill_set)); 
	  $lastWater = $row_bill_set['current_month_water'];?>
  <tr>
    <td colspan="12"><a href="<?php printf("%s?pageNum_bill_set=%d%s", $currentPage, max(0, $pageNum_bill_set - 1), $queryString_bill_set); ?>">前一页</a> <a href="<?php printf("%s?pageNum_bill_set=%d%s", $currentPage, min($totalPages_bill_set, $pageNum_bill_set + 1), $queryString_bill_set); ?>"> 下一个</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($bill_set);
?>
