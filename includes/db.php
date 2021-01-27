<?php
	$dbhost = "localhost";
	 $dbuser = "root";
	 $dbpass = "";
	 $db = "ehostel";
	 $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);

	 if ($conn==false) {
	 	echo "<h1>Error while establishing connection with database.</h1>";
	 	exit();
	 }
?>