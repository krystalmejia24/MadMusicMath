#!/usr/local/bin/php

<html><body>

<?php
session_start();
session_destroy();
print "Logout Successful";
?>

<br>Will redirect back to the home page in 3 seconds.<br>
<meta http-equiv="refresh" content="3;url=index.php" />
</body></html>
