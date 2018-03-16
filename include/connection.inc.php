<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "onlinestore";
	
	$conn = mysqli_connect($servername, $username, $password, $database);
	
	if($conn != TRUE) {
		echo "DATABASE CONNECTION ERROR!";
	}
?>