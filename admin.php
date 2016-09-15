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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_house = 10;
$pageNum_house = 0;
if (isset($_GET['pageNum_house'])) {
  $pageNum_house = $_GET['pageNum_house'];
}
$startRow_house = $pageNum_house * $maxRows_house;

$sessi_house = "root";
if (isset($_SESSION['MM_Username'])) {
  $sessi_house = $_SESSION['MM_Username'];
}
mysql_select_db($database_conn, $conn);
$query_house = sprintf("select *  from house ,manage where manage.adminID=%s and house.ID=manage.houseID", GetSQLValueString($sessi_house, "text"));
$query_limit_house = sprintf("%s LIMIT %d, %d", $query_house, $startRow_house, $maxRows_house);
$house = mysql_query($query_limit_house, $conn) or die(mysql_error());
$row_house = mysql_fetch_assoc($house);

if (isset($_GET['totalRows_house'])) {
  $totalRows_house = $_GET['totalRows_house'];
} else {
  $all_house = mysql_query($query_house);
  $totalRows_house = mysql_num_rows($all_house);
}
$totalPages_house = ceil($totalRows_house/$maxRows_house)-1;

$queryString_house = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_house") == false && 
        stristr($param, "totalRows_house") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_house = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_house = sprintf("&totalRows_house=%d%s", $totalRows_house, $queryString_house);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
if(!isset($_SESSION))
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin</title>
</head>
<body>
<h3>
welecon admin <?php echo $_SESSION['MM_Username']; ?> 
<!-- #BeginDate format:IS1a -->2016-09-15 9:47 PM<!-- #EndDate -->
<table width="99%" border="1" align="center" cellpadding="2" cellspacing="2">
  <caption>
  house scan
  </caption>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">city</th>
    <th scope="col">substrict</th>
    <th scope="col">building </th>
    <th scope="col">unit</th>
    <th scope="col">room</th>
    <th scope="col">edit</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_house['ID']; ?></td>
      <td><?php echo $row_house['city']; ?></td>
      <td><?php echo $row_house['subdistrict']; ?></td>
      <td><?php echo $row_house['building']; ?></td>
      <td><?php echo $row_house['unit']; ?></td>
      <td><?php echo $row_house['room']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php } while ($row_house = mysql_fetch_assoc($house)); ?>
  <tr>
    <td colspan="4">前一页 &nbsp;&nbsp;<a href="<?php printf("%s?pageNum_house=%d%s", $currentPage, min($totalPages_house, $pageNum_house + 1), $queryString_house); ?>">下一个</a></td>
    <td colspan="4">edit_the_house</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($house);
?>
