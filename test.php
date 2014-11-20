#!/usr/local/bin/php

<html><head><title>PHP Test</title></head>
<body>
<?php
$username = $_POST["username"];
$password = $_POST["pass"];
$search = $_POST["search"];
$address = '//oracle.cise.ufl.edu/orcl';

putenv("ORACLE_HOME=/usr/local/libexec/oracle/app/oracle/product/11.2.0/client_1");
$connect = oci_connect($username, $pass, $address);
$sql = oci_parse($connect, 'SELECT * FROM test WHERE name LIKE %search%');
oci_execute($sql);

while(($row = oci_fetch_object($sql)) {
	var_dump($row);
}

oci_free_statement($ql);
oci_close($connect);

?>
</body></html>