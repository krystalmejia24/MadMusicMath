#!/usr/local/bin/php


<html>
<head><h3>Home Page</h3>
<body>

<?php if(!isset($_COOKIE["user"]) || $_COOKIE["user"] == null): ?>
	<a href="userLogin.php">User Login</a>
<?php else: ?>
	<a href="user.php">User $COOKIE["user"] Info</a>
<?php endif; ?>
<br><br>
<form action="homeSearch.php" method="post">
Search: <input type = "text" name="search"><br>
Song: <input type = "radio" name="type" value="song">   Artist: <input type = "radio" name="type" value="artist">   Album: <input type = "radio" name="type" value="album"><br>
<input type="submit">
</form>

</body>
</html> 