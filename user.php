#!/usr/local/bin/php

 
 <?php
	include userLogic.php; //Contains userInfo function - Takes the username as argument and returns the 2D array from oci_fetch_all
 
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
	$userData = userInfo($_COOKIE["user"]);
	for($row = 0; $row < count($userData); $row++)
	{
		$activeData = $userData[$row];
		echo $activeData[0];
		echo $activeData[1];
		echo $activeData[2];
		echo $activeData[3];
	}
?>
 
 </body>
 </html>