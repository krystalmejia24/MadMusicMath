#!/usr/local/bin/php
<!-- userSearch gets passed through POST 'searchText' and 'searchType' -->

<html>
<head><h1>Mad Music Math</h1></head>
<body>

<?php if(!isset($_COOKIE["user"]) || $_COOKIE["user"] == null): ?>
	<a href="login.php">User Login</a>
<?php else: ?>
	<a href="user.php">User $COOKIE["user"] Info</a>
<?php endif; ?>
<br><br>
<form action="searchResults.php" method="post">
Search: <input type = "text" name="searchText"><br>
&nbsp;&nbsp;<input type = "radio" name="searchType" value="song">Song<br>   
&nbsp;&nbsp;<input type = "radio" name="searchType" value="artist">Artist<br>   
&nbsp;&nbsp;<input type = "radio" name="searchType" value="album">Album<br>
<input type="submit">
</form>

</body>
</html> 