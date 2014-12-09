#!/usr/local/bin/php

<html>
<head><h3>Album</h3></head>
<body>

<?php
	if($_GET["id"] != null)
	{
		$query; $fetch; $songs; $search = $_GET["id"];
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("kmejia", "colombia24", "oracle.cise.ufl.edu:1521/orcl");
		
		$query = ociparse($conn, 
			"SELECT a1.release, a1.release_date, a2.name, a2.artist_id
			FROM dballard.albums a1, dballard.artists a2
			WHERE a1.album_id = :search_bv AND a2.artist_id = a1.artist_id"
		);
		oci_bind_by_name($query, ":search_bv", $search);
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		
		
		echo "Album: " . $fetch["RELEASE"][0] . "<br>Year: " . $fetch["RELEASE_DATE"][0] . "<br><br>";
		$address1 = "artist.php?id=" . $fetch["ARTIST_ID"][0];
		echo "<b>Artist:</b><a href=$address1> " . $fetch["NAME"][0] ."</a><br>";
	}
	
		$songs = ociparse($conn,
			"SELECT title, song_id
			FROM dballard.songs
			WHERE album_id = :search_bv"
		);
		oci_bind_by_name($songs, ":search_bv", $search);
		ociexecute($songs);
		oci_fetch_all($songs, $fetch1);
		ocilogoff($conn);
		
		echo "<br><b>Songs</b><br>"; 
		for($row = 0; $row < count($fetch1["TITLE"]); $row++)
		{
			$address = "song.php?id=" . $fetch1["SONG_ID"][$row];
			echo "&nbsp &nbsp Track ";
			echo $row+1;
			echo ": <a href=$address>" . $fetch1["TITLE"][$row] . "</a><br>";
		}
?>

</body>
</html>
