#!/usr/local/bin/php

<?php
session_start();
if(!session_is_registered("username")){
  header("location:login.php");
}
?>

<html>
<body>
<h1>Welcome!</h1>
<b>Login Successful!</b>
<br>Will redirect back to the home page in 3 seconds.<br>
<meta http-equiv="refresh" content="3;url=index.php" />
</body>
</html>
