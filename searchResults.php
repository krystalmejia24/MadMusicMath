#!/usr/local/bin/php

<?php
	if($_POST["searchText"] != null)
	{
		$search = $_POST["searchText"];
		$db; $syntax;
		switch($_POST["searchType"])
		{"
			case "song": $dB = "dballard.song"; $syntax = "name"; break;
			case "artist": $dB = "dballard.artist"; $syntax = "release"; break;
			case "album": $dB = "dballard.album"; $syntax = "title"; break;
		}
		
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		//Replace USERNAME and PASSWORD with own
		$conn = ocilogon("USERNAME, $_POST["dbPass"], "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME with your own. Temporarily pulling passwords from form
		$query = ociparse($conn, "SELECT * FROM :db_bv WHERE :syntax_bv = :search_bv");
		oci_bind_by_name($query, ":db_bv", $db);
		oci_bind_by_name($query, ":syntax_bv", $syntax);
		oci_bind_by_name($query, ":search_bv", ("%" + $search + "%");
		ociexecute($query);
		oci_fetch_all($query, $fetch);
		oci_free_statement($query);
		ocilogoff($conn);
		
		for($row = 0; $row < count($fetch); $row++)
		{
			$dataRow = $fetch[$row];
			for($column; $column < count($dataRow); $column++)
			{
				echo $dataRow[$column];
			}
		}

	} else {
		 header("Location:index.php");
	}
	
?>