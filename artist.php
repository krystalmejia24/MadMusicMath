#!/usr/local/bin/php

<html>
<head><h3>Artist</h3></head>
<body>

<?php
	if($_GET["id"] != null)
	{
		$query; $fetch; $search = $_GET["id"];
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("kmejia", "colombia24", "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Replace password
		
		$query = ociparse($conn, 
			"SELECT *
			FROM dballard.artists
			WHERE artist_id = :search_bv"
		);
		oci_bind_by_name($query, ":search_bv", $search);
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		ocilogoff($conn);
		
		//var_dump($fetch);
		
		echo "Name: " . $fetch["NAME"][0] . "<br>Birthplace: " . $fetch["BIRTHPLACE"][0] . "<br>";

	}
?>
</body>
</html>