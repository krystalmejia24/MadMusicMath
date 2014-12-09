#!/usr/local/bin/php
<html>
<title>Mad Music Math</title>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
<div id="wrap">
   <h1>Login</h1>
   
   <!-- Here's all it takes to make this navigation bar. -->
   <ul id="nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="user.php">Profile</a></li>
      <li><a href="login.php">Login</a></li>
      
   </ul>
   <!-- That's it! -->

<table width="300" border="1" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <form name="login" method="post" action="logincheck.php">
      <td>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
          <tr>
            <td colspan="3"><strong>Member Login</strong></td>
          </tr>
          <tr>
            <td width="78">Username</td>
            <td width="6">:</td>
            <td width="294"><input name="username" type="text" id="username"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td>:</td>
            <td><input name="password" type="password" id="password"></td>
          </tr>
          <tr>
            <td>&nbsp;</td><td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Login"></td>
          </tr>
        </table>
      </td>
    </form>
  </tr>
</table>
</div>
</body>
</html>
