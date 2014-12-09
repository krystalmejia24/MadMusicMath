#!/usr/local/bin/php
<?php
include 'userLogic.php'; //Contains userInfo function - Takes the username as argument and returns the 2D array from oci_fetch_all
?>
<html>
<title>Mad Music Math</title>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
<div id="wrap">
   <h1>Profile</h1>
   
   <!-- Here's all it takes to make this navigation bar. -->
   <ul id="nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="user.php">Profile</a></li>
      <li><a href="login.php">Login</a></li>
      
   </ul>
   <!-- That's it! -->
   
   
<?php
session_start();
if(!session_is_registered("username")) {
	echo "No user signed in";
	echo "<br><a href='login.php'>Login</a>";
} 
else {
$userData = userInfo($_SESSION["username"]);
echo $userData["USERNAME"][0] . " " . $userData["COUNTRY"][0] . " " . $userData["CITY"][0] . "<br>";
echo "<br><a href='logout.php'>Logout</a>";
}
?>
</div>
</body>
</html>
