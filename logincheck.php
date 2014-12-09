#!/usr/local/bin/php

<?php

putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
$conn = ocilogon("dballard", "Aa125897", "oracle.cise.ufl.edu:1521/orcl");

$username = $_POST['username'];
$password = $_POST['password'];

$search = ociparse($conn, "SELECT username, password FROM users WHERE username='$username' and password='$password'");
ociexecute($search);

if($value=oci_fetch_row($search)){
  session_start();
  session_register("username");
  session_register("password");
  $_SESSION["username"] = $username;
  $_SESSION["password"] = $password;
  header("location:login_success.php");
}
else {
  echo "<html><body>";
  echo "<b>Login failed.<b><br>";
  echo "<a href=\"login.php\">Try Again?</a>";
  echo "</body></html>";
}

oci_free_statement($search);
ocilogoff($conn);

?>
