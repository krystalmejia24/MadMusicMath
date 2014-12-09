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
		$conn = ocilogon("lorelle", $_POST["dbPass"], "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Temporarily pulling passwords from form
		switch($_POST["searchType"])
		{
			case "song": $query = ociparse($conn, 
			"SELECT title, song_id FROM dballard.songs WHERE title LIKE :search_bv ORDER BY title"); 
			break;
			case "artist": $query = ociparse($conn, 
			"SELECT name, artist_id FROM dballard.artists WHERE name LIKE :search_bv ORDER BY name"); 
			break;
			case "album": $query = ociparse($conn, 
			"SELECT release, album_id FROM dballard.albums WHERE release LIKE :search_bv ORDER BY release"); 
			break;
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
					$title = $fetch["TITLE"][$row];
					//echo "Name: " . $fetch["TITLE"][$row] . "<br>Album: " . $fetch["RELEASE"][$row] . "<br><a href=$address>More Info</a><br><br>";
					echo "<a href=$address>$title</a><br>";
				}
			break;
			case "artist": 
				for($row = 0; $row < count($fetch["NAME"]); $row++)
				{
					$address = "artist.php?id=" . $fetch["ARTIST_ID"][$row];
					$title = $fetch["NAME"][$row];
					echo "<a href=$address>$title</a><br>";
				}
			break;
			case "album": 
				for($row = 0; $row < count($fetch["RELEASE"]); $row++)
				{
					$address = "album.php?id=" . $fetch["ALBUM_ID"][$row];
					$title = $fetch["RELEASE"][$row];
					echo "<a href=$address>$title</a><br>";
				}
			break;
		}
	} else { ?>
	<script>top.location = 'index.php';</script>
<?php } ?>
</body>
</html>