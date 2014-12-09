#!/usr/local/bin/php

 
 <?php
	include 'userLogic.php'; //Contains userInfo function - Takes the username as argument and returns the 2D array from oci_fetch_all
 ?>
 
 <html>
 <body>

 <?php
	session_start();
	if(!session_is_registered("username")) {
		echo "No user signed in";
	} else {
		$userData = userInfo($_SESSION["username"]);
		echo $userData["USERNAME"][0] . " " . $userData["COUNTRY"][0] . " " . $userData["CITY"][0] . "<br>";
	}
?>
 <br>
 <a href='logout.php'>Logout</a>
 </body>
 </html>