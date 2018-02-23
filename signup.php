<?php
	include '../passdb.php';
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
	 	die("Connection failed: " . $conn->connect_error);
	}
	$sql = "CREATE DATABASE IF NOT EXISTS cloudportalDB";
	if ($conn->query($sql) === TRUE) {
    		$sqluse = "USE cloudportalDB";
    		$conn->query($sqluse);
	} else {
		echo "Error creating database: " . $conn->error;
	}
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$email = $_POST["email"];
	$sqli = "INSERT INTO customer (username, emailid, password) VALUES ('$user','$email','$pass')";
		if ($conn->query($sqli) === TRUE) {
    			header("Location:afterlogin.php?user=".$_POST["user"]);
    		}
    		else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		} 
	$conn->close();
	
?>
