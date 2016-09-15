<?php
if(!isset($_SESSION))
	session_start();
include("Connections/conn.php");
$query=mysql_query("select * from householder");
$info=mysql_fetch_array($query);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="JS/menu.JS"></script>
<div class=menuskin id=popmenu
      onmouseover="clearhidemenu();highlightmenu(event,'on')"
      onmouseout="highlightmenu(event,'off');dynamichide(event)" style="Z-index:100;position:absolute;"></div>
<table width="776" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="115" align="right" valign="bottom" background="Images/banner.gif" bgcolor="#FD9C11"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="26" align="right">当前登录的用户：<?php echo $_SESSION['MM_Username']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="33" align="right" background="Images/menu_line1.gif" bgcolor="#FD9C11"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5%"></td>
        <td width="23%"><script type=text/javascript>
		document.write("<span id='labtime' width='120px' Font-Size='9pt'></span>")
		setInterval("labtime.innerText=new Date().toLocaleString()",1000)
		</script></td>
        <td width="70%" align="right"><a href="main.php" class="a1">首页</a> ┊ 
    <a  onmouseover=showmenu(event,querymenu) onmouseout=delayhidemenu()  style="CURSOR:hand" class="a1">系统查询</a> ┊
    <a  href="update.php?ID=<?php echo $_SESSION['MM_Username']; ?>" class="a1">修改个人信息</a> ┊ <a href="safequit.php" class="a1">注销</a></td>
        <td width="2%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
