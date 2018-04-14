<?php
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	$user = $_SESSION['user'];
	include_once '../passdb.php';
	$dbname = "cloudportalDB";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$delall = "TRUNCATE TABLE $user";
	echo $delall;
	echo "<br>";
        $display_query = mysqli_query($conn, $delall);
        if (!$display_query) {
               die ('SQL Error: ' . mysqli_error($conn));
        }

	$deluser= "DELETE FROM customer WHERE username='$user'";
	echo $deluser;
	echo "<br>";
        $display_query = mysqli_query($conn, $deluser);
        if (!$display_query) {
               die ('SQL Error: ' . mysqli_error($conn));
        }
	$droptable= "DROP TABLE $user";
	echo $droptable;
	echo "<br>";
        $display_query = mysqli_query($conn, $droptable);
        if (!$display_query) {
               die ('SQL Error: ' . mysqli_error($conn));
        }
	header("Location:./logout.php");

?>
