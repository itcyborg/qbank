<?php
	if(file_exists('../system/define.php')){
		include('../system/define.php');
	}else{
		die(include('../views/503.html'));
	}

	// Create connection
	$conn = new mysqli($servername, $dbusername, $dbpassword,$dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>