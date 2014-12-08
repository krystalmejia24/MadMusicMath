#!/usr/local/bin/php

<html>
<head><h3>Results</h3>
<body>

<?php
	if($_POST["searchText"] != null)
	{
		$search = "%" . $_POST["searchText"] . "%";
		echo $search . "<br><br>";
		$query; $fetch;
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("lorelle", $_POST["dbPass"], "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Temporarily pulling passwords from form
		switch($_POST["searchType"])
		{
			case "song": $query = ociparse($conn, "SELECT * FROM dballard.songs WHERE title LIKE :search_bv"); break;
			case "artist": $query = ociparse($conn, "SELECT * FROM dballard.artists WHERE name LIKE :search_bv"); break;
			case "album": $query = ociparse($conn, "SELECT * FROM dballard.albums WHERE release LIKE :search_bv"); break;
			default: $query = ociparse($conn, "SELECT * FROM dballard.songs WHERE :syntax_bv LIKE :search_bv"); break;
		}
		//oci_bind_by_name($query, ":db_bv", $dB);
		//oci_bind_by_name($query, ":syntax_bv", $syntax);
		oci_bind_by_name($query, ":search_bv", $search);
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		ocilogoff($conn);
		
		//var_dump($fetch);
		
		foreach($fetch as $row)
		{
			foreach($row as $column)
			{
				echo " " . $column . " ";
			}
			echo "<br>";
		}
	}
?>
</body>
</html>