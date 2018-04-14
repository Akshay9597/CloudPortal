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
//	$filename = $_GET['filename'];
//	echo $filename;

	if( isset($_GET['del']) )
	{
		$filename = $_GET['del'];
		$sql= "DELETE FROM $user WHERE filename= '$filename'";
		echo $sql;
		echo "<br>";
	//	$res= mysql_query($sql) or die("Failed".mysql_error());

	        $display_query = mysqli_query($conn, $sql);
	        if (!$display_query) {
	               die ('SQL Error: ' . mysqli_error($conn));
	        }
	//	echo "<meta http-equiv='refresh' content='0;url=showfiles.php'>";
	}
	header("Location:showfiles.php");
/*
	$delete = $_POST['delete'];

	foreach($delete as $id = $value)
	{

	    mysql_query("DELETE FROM table_name WHERE id = $id");
	}

*/
/*
	$del = "DELETE FROM ".$user." WHERE filename = ".$filename;
	echo $del;
	$del_query = mysqli_query($conn, $del);
        if (!$del_query) {
               die ('SQL Error: ' . mysqli_error($conn));
        }
	echo $del;*/
?>
