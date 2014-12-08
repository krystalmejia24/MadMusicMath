#!/usr/local/bin/php

<?php
	function userInfo($userName)
	{
		putenv("ORACLE_HOME=/usr/local/libexec/oracle11g-client");
		$conn = ocilogon("USERNAME", "PASSWORD", "oracle.cise.ufl.edu:1521/orcl"); //Replace USERNAME and PASSWORD with own
		$query = ociparse($conn, "SELECT * FROM dballard.user WHERE username = :name_bv");
		oci_bind_by_name($query, ":name_bv", $username);
		ociexecute($query);
		oci_fetch_all($query, $fetchAll);
		oci_free_statement($query);
		ocilogoff($conn);
		return $fetchAll;
	}
?>