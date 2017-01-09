<?php
	$enable = true;
	if($enable)
	{
		$DBHost = "localhost";
		$SQLUsername = "root";
		$SQLPassword = "121586";
		$DBName = "gwc_db";
		
		$mysqli = new mysqli("$DBHost", "$SQLUsername", "$SQLPassword", "$DBName");
	}
?>