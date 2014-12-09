#!/usr/local/bin/php

<html>
<head><h3>Song</h3></head>
<body>

<?php
	if($_GET["id"] != null)
	{
		$query; $fetch; $search = $_GET["id"];
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("lorelle", PASSWORD, "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Replace password
		$query = ociparse($conn, 
			"SELECT xx.*, art.name 
			FROM dballard.artists art,
			(SELECT x.*, alb.release, alb.artist_id
			FROM dballard.albums alb, 
			(SELECT *
			FROM dballard.songs
			WHERE song_id = :search_bv
			) x
			WHERE x.album_id = alb.album_id
			) xx
			WHERE xx.artist_id = art.artist_id"
			);
			
		oci_bind_by_name($query, ":search_bv", $search);
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		ocilogoff($conn);
		
		//var_dump($fetch);
		
		echo "Name: " . $fetch["TITLE"][0] . "<br>Album: " . $fetch["RELEASE"][0] . "<br>Artist: " . $fetch["NAME"][0] . "<br>";
		echo "Duration: " . $fetch["DURATION"][0] . "<br>Tempo: " . $fetch["TEMPO"][0];
	}
?>
</body>
</html>