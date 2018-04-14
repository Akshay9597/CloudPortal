<?php
	session_start();
	$_SESSION["user"] = $_POST["user"];

	include './passdb.php';
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
	$fullname = $_POST["fullname"];

	$sqli = "INSERT INTO customer (username, fullname, emailid, password) VALUES ('$user','$fullname','$email','$pass')";
	if ($conn->query($sqli) === TRUE) {
		$sql_create = "CREATE TABLE `cloudportalDB`.`$user` ( `filename` VARCHAR(128) NOT NULL , `filesize` INT NOT NULL, `title` VARCHAR(128), PRIMARY KEY (`filename`)) ENGINE = InnoDB";
		if($conn->query($sql_create) == TRUE) {
	//	echo "User table created";
		}
    			header("Location:uploadform.php");
    	}
    	else {
		echo "<script type=\"text/javascript\">window.alert('Usernanme already taken. Please try another one!');window.location.href = 'signup.html';</script>"; 
   		exit;
 //   		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
	
?>
