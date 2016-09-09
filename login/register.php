<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>register</title>
</head>

<body>
<form action="login.php" method="post" id="form1" target="_self"></form>
<table width="419" border="1" cellspacing="2" cellpadding="2" summary="摘要">
  <caption>
    请阅读提示信息，认真填写，谢谢~
  </caption>
  <tr>
    <th width="17" scope="row">登录账号</th>
    <td width="382">
    <input type="text" name="ID" id="ID" /></td>
  </tr>
  <tr>
    <th scope="row">密码</th>
    <td><input type="text" name="pwd" id="pwd" /></td>
  </tr>
  <tr>
    <th scope="row">密码验证</th>
    <td><input type="text" name="pwd2" id="pwd2" /></td>
  </tr>
  <tr>
    <th scope="row">真实姓名</th>
    <td><input type="text" id="name" /></td>
  </tr>
  <tr>
    <th scope="row">手机号</th>
    <td><input type="text" name="phone" id="phone" /></td>
  </tr>
  <tr>
    <th scope="row">性别</th>
    <td><table width="200">
      <tr>
        <td nowrap="nowrap"><label>
          <input type="radio" name="RadioGroup1" value="男" id="RadioGroup1_0" />
          男</label></td>
      </tr>
      <tr>
        <td nowrap="nowrap"><label>
          <input type="radio" name="RadioGroup1" value="女" id="RadioGroup1_1" />
          女</label></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <th scope="row">出生年月</th>
    <td><select name="year" id="year">
    </select>     <select name="month" id="month">
    </select>  </td>
  </tr>
  <tr>
    <th scope="row">密码找回问题</th>
    <td><textarea name="question" id="question" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <th scope="row">找回答案</th>
    <td><input type="text" name="answer" id="answer" /></td>
  </tr>
  <tr>
    <th colspan="2" scope="row"><input name="submit" type="button" value="注册" />&nbsp;</th>
  </tr>
</table>
</body>
</html>