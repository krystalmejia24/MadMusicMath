#!/usr/local/bin/php
<!-- userSearch gets passed through POST 'searchText' and 'searchType' -->

<html>
<head><h3>Home Page</h3>
<body>

<?php if(!isset($_COOKIE["user"]) || $_COOKIE["user"] == null): ?>
	<a href="userLogin.php">User Login</a>
<?php else: ?>
	<a href="user.php">User $COOKIE["user"] Info</a>
<?php endif; ?>
<br><br>
<form action="searchLogic.php" method="post">
Search: <input type = "text" name="searchText"><br>
Song: <input type = "radio" name="searchType" value="song">   Artist: <input type = "radio" name="searchType" value="artist">   Album: <input type = "searchType" name="type" value="album"><br>
<input type="submit">
</form>

</body>
</html> 