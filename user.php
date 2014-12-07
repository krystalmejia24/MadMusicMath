#!/usr/local/bin/php
 
 <?php
	$cookie_name="user";
	$cookie_value=null;
	setcookie($cookie_name, $cookie_value, time() + 86400, "/");
 ?>
 
 <html>
 <body>

 <?php
	if(!isset($_COOKIE["user"]) || $_COOKIE["user"] == null) {
		//error message
	 }
	//display user stuff here
?>
 
 </body>
 </html>