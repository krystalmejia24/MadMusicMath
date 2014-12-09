#!/usr/local/bin/php
<!-- userSearch gets passed through POST 'searchText' and 'searchType' -->
<html>
<title>Mad Music Math</title>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
<div id="wrap">
   <h1>Mad Music Math</h1>
   
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
	echo "<a href='login.php'>User Login</a>";
}
else {
	$user = $_SESSION['username'];
	echo "<a href='user.php'>$user</a>";
} 
?>
<br><br>
<form action="searchResults.php" method="post">
Search: <input type = "text" name="searchText"><br><br>
&nbsp;&nbsp;<input type = "radio" name="searchType" value="song">Song  
&nbsp;&nbsp;<input type = "radio" name="searchType" value="artist">Artist  
&nbsp;&nbsp;<input type = "radio" name="searchType" value="album">Album<br><br>
<input type="submit">
</form>
</div>
</body>
</html> 
