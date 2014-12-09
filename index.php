#!/usr/local/bin/php
<!-- userSearch gets passed through POST 'searchText' and 'searchType' -->

<html>
<head><h3>Home Page</h3></head>
<body>
<?php 
session_start();
if(!session_is_registered("username")) {
	echo "<a href='login.php'>User Login</a>";
} else {
	$user = $_SESSION['username'];
	echo "<a href='user.php'>User $user Info</a>";
} 
?>
<br><br>
<form action="searchResults.php" method="post">
Search: <input type = "text" name="searchText"><br>
Song: <input type = "radio" name="searchType" value="song">   Artist: <input type = "radio" name="searchType" value="artist">   Album: <input type = "radio" name="searchType" value="album"><br>
dbPass: <input type = "password" name="dbPass"><br>
<input type="submit">
</form>

</body>
</html> 