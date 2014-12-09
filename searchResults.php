#!/usr/local/bin/php

<html>
<head><h3>Results</h3></head>
<body>

<?php
	if($_POST["searchText"] != null)
	{
		$search = "% " . $_POST["searchText"] . " %"; //No partial-word matches
		$query; $fetch;
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("kmejia", "colombia24", "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Temporarily pulling passwords from form
		switch($_POST["searchType"])
		{
			case "song": $query = ociparse($conn, 
			"SELECT s.title, s.song_id, a.release FROM dballard.songs s, dballard.albums a WHERE title LIKE :search_bv AND s.album_id = a.album_id ORDER BY title"
			); break;
			case "artist": $query = ociparse($conn, "SELECT name, artist_id FROM dballard.artists WHERE name LIKE :search_bv"); break;
			case "album": $query = ociparse($conn, "SELECT release, album_id FROM dballard.albums WHERE release LIKE :search_bv"); break;
			default: echo "searchType error"; break;
		}
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
				{
					$address = "song.php?id=" . $fetch["SONG_ID"][$row];
					echo "Name: " . $fetch["TITLE"][$row] . "<br>Album: " . $fetch["RELEASE"][$row] . "<br><a href=$address>More Info</a><br><br>";
				}
			break;
			case "artist": 
				for($row = 0; $row < count($fetch["NAME"]); $row++)
				{
					$address = "artist.php?id=" . $fetch["ARTIST_ID"][$row];
					echo "Name: " . $fetch["NAME"][$row] . "<br><a href=$address>More Info</a><br><br>";
				}
			break;
			case "album": 
				for($row = 0; $row < count($fetch["RELEASE"]); $row++)
				{	
					$address = "album.php?id=" . $fetch["ALBUM_ID"][$row];
					echo "Album: " . $fetch["RELEASE"][$row] . "<br><a href=$address>More Info</a><br><br>";
				}
			break;
		}
	} else 
	{ ?>
		<script>top.location = 'index.php';</script>
		<?php 
	} ?>
</body>
</html>