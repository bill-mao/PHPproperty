<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<table width="941" height="290" border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td width="929" height="167" align="right"><p>
        登陆成功！欢迎您：<?php echo $_SESSION['MM_Username']; ?></p>
      <p><a href="../login/update.php?ID<?php echo $_SESSION['MM_UserID']; ?>" >修改您的个人信息</a>&nbsp; <a href="<?php echo $logoutAction ?>" herf="../login/login.php">注销您的账户</a></p></td>
  </tr>
  <tr>
    <td width="5%"></td>
    <td width="23%"><script type=text/javascript>
		document.write("<span id='labtime' width='120px' Font-Size='9pt'></span>")
		setInterval("labtime.innerText=new Date().toLocaleString()",1000)
		</script></td>
    <td width="70%" align="right"><a href="index.php" class="a1">首页</a> ┊
      <?php if($info['sysset']==1){ ?>
      <a  onmouseover=showmenu(event,sysmenu) onmouseout=delayhidemenu()  style="CURSOR:hand"  class="a1">系统设置</a> ┊
      <?php }?>
      <?php if($info['readerset']==1){?>
      <a  onmouseover=showmenu(event,readermenu) onmouseout=delayhidemenu()  style="CURSOR:hand" class="a1">读者管理</a> ┊
      <?php } ?>
      <?php if($info['bookset']==1){ ?>
      <a href="book.php" class="a1">图书档案管理</a> ┊
      <?php }?>
      <?php if($info['borrowback']==1){?>
      <a  onmouseover=showmenu(event,borrowmenu) onmouseout=delayhidemenu() style="CURSOR:hand"class="a1" >图书借还</a> ┊
      <?php }?>
      <?php if($info['sysquery']==1){ ?>
      <a  onmouseover=showmenu(event,querymenu) onmouseout=delayhidemenu()  style="CURSOR:hand" class="a1">系统查询</a> ┊
      <?php } ?>
      <a  href="pwd_Modify.php" class="a1">更改口令</a> ┊ <a href="safequit.php" class="a1">注销</a></td>
    <td width="2%">&nbsp;</td>
  </tr>
</table>
</body>
</html>