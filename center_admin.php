<?php if(!isset($_SESSION))
	session_start();
?>
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
	overflow: hidden;
}
-->
</style>
<style>
.navPoint {
	COLOR: white;
	CURSOR: hand;
	FONT-FAMILY: Webdings;
	FONT-SIZE: 9pt
}
</style>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/menu.js"></script>
<script>
function switchSysBar(){ 
var locate=location.href.replace('center.html','');
var ssrc=document.all("img1").src.replace(locate,'');
if (ssrc=="images/main_18.gif")
{ 
document.all("img1").src="images/main_18_1.gif";
document.all("frmTitle").style.display="none" 
} 
else
{ 
document.all("img1").src="images/main_18.gif";
document.all("frmTitle").style.display="" 
} 
} 
</script>
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
  <tr>
    <td width="200" id=frmTitle noWrap name="fmTitle" align="center" valign="top"><div height="100%" width="180" class="box">
        <h2>折叠菜单</h2>
        <ul class="menu">
          <li class="level1"><a href="#none">房屋管理</a>
          <ul class="level2">
              <li  onClick="showHouses()" ><a href="#none">查看房屋</a></li>
         
            </ul>
          </li>
          <li class="level1"> <a href="#none">用户管理</a>
            <ul class="level2">
              <li onClick='ownhouse()'><a href="#none">关联用户房屋</a></li>
              <li><a href="#none">查看用户</a></li>
         
            </ul>
          </li>
          <li class="level1"> <a href="#none">费用使用情况</a>
            <ul class="level2">
              <li onClick="createbill()" ><a href="#none">输入房屋水电费</a></li>
              <li  ><a href="#none">缴费</a></li>
            </ul>
          </li>
          <li class="level1"> <a href="#none" >物业问题反映</a>
            <ul class="level2">
              <li onClick="showsolvecomplaint()"><a  href="#none">已解决投诉问题</a></li>
               <li onClick="shownotcom()"><a  href="#none">未解决投诉列表</a></li>
             
            </ul>
          </li>
        </ul>
        </li>
        </ul>
      </div></td>
    <td width="8" valign="middle" background="images/main_12.gif" onclick=switchSysBar()><span class="navPoint"><img src="images/main_18.gif" name="img1" width=8 height=52 id=img1></span></td>
    <td align="center" valign="top"><iframe name="I2" id="tab" height="100%" width="100%" border="0" frameborder="0" src=""> 浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe></td>
    <td width="4" align="center" valign="top" background="images/main_20.gif">　</td>
  </tr>
</table>
</body>
</html>
