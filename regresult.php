#!/usr/local/bin/php

<html><body>

<?php

putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
$conn = ocilogon("dballard", "Aa125897", "oracle.cise.ufl.edu:1521/orcl");

$username = $_POST['username'];
$password = $_POST['password'];
$country = $_POST['country'];
$city = $_POST['city'];
$DOB = $_POST['DOB'];
$ethnicity = $_POST['ethnicity'];

$search = ociparse($conn, "SELECT username FROM users WHERE username='$username'");
ociexecute($search);

if($value=oci_fetch_row($search)){
  echo "Username taken, going back to registration";
  echo "<meta http-equiv=\"refresh\" content=\"3;url=register.php\" />";
}
else {
  $insert = ociparse($conn, "INSERT INTO users (username, password, country, city, DOB, ethnicity) VALUES ('$username', '$password', '$country', '$city', TO_DATE('$DOB', 'YYYY/MM/DD'), '$ethnicity')");
  oci_bind_by_name($insert, ':SQL_CHR', $username);
  oci_bind_by_name($insert, ':SQL_CHR', $password);
  oci_bind_by_name($insert, ':SQL_CHR', $country);
  oci_bind_by_name($insert, ':SQL_CHR', $city);
  oci_bind_by_name($insert, ':SQL_CHR', $ethnicity);
  ociexecute($insert);
  session_start();
  session_register("username");
  session_register("password");
  $_SESSION["username"] = $username;
  $_SESSION["password"] = $password;
  echo "<h1>User account created!</h1>";
  echo "You are now logged in.<br>";
  echo "Welcome to the site, $username<br>";
  echo "Redirecting to the home page in 5 seconds...";
  echo "<meta http-equiv=\"refresh\" content=\"3;url=index.php\"";
}

oci_free_statement($search);
oci_free_statement($insert);
ocilogoff($conn);
oci_close($conn);

?>

</body></html>
