#!/usr/local/bin/php

<html>
<head><h3>Results</h3>
<body>

<?php
	if($_POST["searchText"] != null)
	{
		$search = "% " . $_POST["searchText"] . " %"; //No partial-word matches
		//echo $search . "<br><br>";
		$query; $fetch;
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("lorelle", $_POST["dbPass"], "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Temporarily pulling passwords from form
		switch($_POST["searchType"])
		{
			case "song": $query = ociparse($conn, 
			"SELECT s.title, a.release FROM dballard.songs s, dballard.albums a WHERE title LIKE :search_bv AND s.album_id = a.album_id ORDER BY title"
			); break;
			case "artist": $query = ociparse($conn, "SELECT name FROM dballard.artists WHERE name LIKE :search_bv"); break;
			case "album": $query = ociparse($conn, "SELECT release FROM dballard.albums WHERE release LIKE :search_bv"); break;
			default: echo "searchType error"; break;
		}
		//oci_bind_by_name($query, ":db_bv", $dB);
		//oci_bind_by_name($query, ":syntax_bv", $syntax);
		oci_bind_by_name($query, ":search_bv", $search);
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		ocilogoff($conn);
		
		//var_dump($fetch);
		
		switch($_POST["searchType"])
		{
			case "song": 
				for($row = 0; $row < count($fetch["TITLE"]); $row++)
					echo "Name: " . $fetch["TITLE"][$row] . "<br>Album: " . $fetch["RELEASE"][$row] . "<br><br>";
			break;
			case "artist": 
				for($row = 0; $row < count($fetch["NAME"]); $row++)
					echo "Name: " . $fetch["NAME"][$row] . "<br>";
			break;
			case "album": 
				for($row = 0; $row < count($fetch["RELEASE"]); $row++)
					echo "Name: " . $fetch["RELEASE"][$row] . "<br>";
			break;
		}
	}
?>
</body>
</html>