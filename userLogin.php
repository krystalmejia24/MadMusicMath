#!/usr/local/bin/php
 
 <?php
	$cookie_name="user";
	$cookie_value=null;
	setcookie($cookie_name, $cookie_value, time() + 86400, "/");
 ?>
 
 <html>
 <body>
 
<?php if(isset($_COOKIE["user"]) && $_COOKIE["user"] !== null): ?>
	<p>User already logged in</p>
<?php else: ?>
	<form action="userLogin.php" method="post">
	Username: <input type = "text" name="userName"><br>
	Password: <input type = "password" name="userPass"><br>
	<input type="submit">
	</form>
<?php endif; ?>
 
 </body>
 </html>