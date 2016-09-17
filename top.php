<?php 
if(! isset($_SESSION))
	session_start();  ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {
	font-size: 12px;
	color: #FFFFFF;
}
.STYLE2 {
	font-size: 12px;
	color: #333333;
}
-->
a:link {
	font-size: 12px;
	color: #000000;
	text-decoration: none;
}
a:visited {
	font-size: 12px;
	color: #000000;
	text-decoration: none;
}
a:hover {
	font-size: 12px;
	color: #00CCFF;
	text-decoration: none;
}
.STYLE4 {
	font-size: 12px
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="11" background="images/main_03.gif"><img src="images/main_01.gif" width="104" height="11"></td>
  </tr>
  <tr>
    <td height="36" background="images/main_07.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="282" height="52" background="images/main_05.gif">&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><span class="STYLE1"><img src="images/home.gif" width="12" height="13"> </span><span class="STYLE4"><a href="main.php" onClick="backMain()">回首页</a></span><span class="STYLE1"> <img src="images/quit.gif" width="16" height="16"> </span><span class="STYLE4"><a href="safequit.php" onclick="logout()" >退出系统</a></span><span class="STYLE1"> </span></td>
              </tr>
            </table></td>
          <td width="247" background="images/main_08.gif"><script type=text/javascript>
		document.write("<span id='labtime' width='120px' Font-Size='9pt'></span>")
		setInterval("labtime.innerText=new Date().toLocaleString()",1000)
		</script>&nbsp;</td>
          <td width="283" background="images/main_09.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/uesr.gif" width="14" height="14"><span class="STYLE2"> 当前登录用户：<?php echo $_SESSION['MM_Username']; ?></span></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<script>
function logout(){  
    parent.window.location = "login.php";  
}
function backMain(){
	parent.window.location="main.php";} 

 </script>
</body>
</html>
